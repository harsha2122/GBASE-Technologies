<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Support\InquiryProtection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

class InquiryController extends Controller
{
    public function store(Request $request, InquiryProtection $protection): RedirectResponse|JsonResponse
    {
        if ($request->filled('contact_fax')) {
            return $this->received($request);
        }

        $data = $request->validate([
            'cf-turnstile-response' => ['nullable', 'string', 'max:2048'],
            'page_source' => ['nullable', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'country_other' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:10000'],
            'product_types' => ['nullable', 'array'],
            'pre_process' => ['nullable', 'array'],
            'freezing_equipment' => ['nullable', 'array'],
            'heating_equipment' => ['nullable', 'array'],
            'equipment_options' => ['nullable', 'array'],
            'product_type' => ['nullable', 'string', 'max:255'],
            'equipment_interest' => ['nullable', 'string', 'max:255'],
            'business_type' => ['nullable', 'string', 'max:255'],
            'production' => ['nullable', 'string', 'max:255'],
            'referral' => ['nullable', 'string', 'max:255'],
            'machine_serial_no' => ['nullable', 'string', 'max:255'],
            'others_specify' => ['nullable', 'string', 'max:255'],
            'part_serial_no' => ['nullable', 'array'],
            'part_serial_no.*' => ['nullable', 'string', 'max:255'],
            'quantity_required' => ['nullable', 'array'],
            'quantity_required.*' => ['nullable', 'integer', 'min:1'],
        ]);

        $protection->verify($request);
        unset($data['cf-turnstile-response']);
        $data['email'] = strtolower(trim($data['email']));

        $partLines = collect($data['part_serial_no'] ?? [])
            ->map(fn ($serial, $i) => [
                'serial_no' => $serial,
                'quantity' => $data['quantity_required'][$i] ?? null,
            ])
            ->filter(fn ($line) => filled($line['serial_no']))
            ->values()
            ->all();

        unset($data['part_serial_no'], $data['quantity_required']);

        $data['part_lines'] = $partLines ?: null;

        if (filled($data['others_specify'] ?? null)) {
            $data['message'] = trim(($data['message'] ?? '')."\nOthers: ".$data['others_specify']);
        }

        unset($data['others_specify']);

        if (blank($data['message'] ?? null) && empty($partLines) && blank($data['machine_serial_no'] ?? null)) {
            throw ValidationException::withMessages(['message' => 'Please describe your requirement or add the part details you need.']);
        }
        $data['message'] = $data['message'] ?? '';

        $duplicateKey = $protection->duplicateKey($data);
        if (! Cache::add($duplicateKey, true, 600)) {
            return $this->received($request, true);
        }

        try {
            Inquiry::create($data);
        } catch (\Throwable $exception) {
            Cache::forget($duplicateKey);
            throw $exception;
        }

        return $this->received($request);
    }

    private function received(Request $request, bool $duplicate = false): RedirectResponse|JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $duplicate
                    ? 'We have already received this enquiry. There is no need to resend it.'
                    : 'Thank you — your enquiry has been received. Our team will get back to you shortly.',
            ]);
        }

        return back()->with('inquiry_sent', true);
    }
}
