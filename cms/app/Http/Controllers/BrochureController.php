<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BrochureController extends Controller
{
    public function __invoke(): BinaryFileResponse|StreamedResponse
    {
        $path = Setting::current()->brochure_path;
        $disk = Storage::disk('local');
        $headers = [
            'Content-Type' => 'application/pdf',
            'Cache-Control' => 'no-store',
            'X-Content-Type-Options' => 'nosniff',
        ];

        if (is_string($path) && str_starts_with($path, 'brochures/')
            && ! str_contains($path, '..') && $disk->exists($path)) {
            return $disk->download($path, 'GBASE-Brochure.pdf', $headers);
        }

        $original = public_path('E-Brochure Final.pdf');
        abort_unless(is_file($original), 404, 'Brochure unavailable.');

        return response()->download($original, 'GBASE-Brochure.pdf', $headers);
    }
}
