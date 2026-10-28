<?php

namespace App\Support;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class InquiryProtection
{
    public function verify(Request $request): void
    {
        if (! config('services.turnstile.enabled')) {
            return;
        }

        if (! config('services.turnstile.site_key') || ! config('services.turnstile.secret_key')) {
            Log::warning('Turnstile is enabled but its keys are not configured.');
            abort(503, 'Verification is temporarily unavailable. Please try again later.');
        }

        $token = $request->input('cf-turnstile-response');
        if (! is_string($token) || $token === '') {
            throw ValidationException::withMessages(['cf-turnstile-response' => 'Please complete the verification before sending your enquiry.']);
        }

        try {
            $response = Http::asForm()->connectTimeout(3)->timeout(8)
                ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                    'secret' => config('services.turnstile.secret_key'),
                    'response' => $token,
                    'remoteip' => $request->ip(),
                ]);
        } catch (ConnectionException) {
            abort(503, 'Verification is temporarily unavailable. Please try again later.');
        }

        if ($response->serverError() || $response->status() === 429) {
            abort(503, 'Verification is temporarily unavailable. Please try again later.');
        }

        if (! $response->successful() || $response->json('success') !== true
            || strtolower((string) $response->json('hostname')) !== strtolower($request->getHost())
            || $response->json('action') !== 'inquiry') {
            throw ValidationException::withMessages(['cf-turnstile-response' => 'Verification failed or expired. Please verify again and retry.']);
        }
    }

    public function duplicateKey(array $data): string
    {
        unset($data['page_source']);
        $data = array_filter($data, fn ($value): bool => filled($value));
        ksort($data);

        return 'inquiry-duplicate:'.hash('sha256', json_encode($data, JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_UNICODE));
    }
}
