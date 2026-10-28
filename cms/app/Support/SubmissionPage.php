<?php

namespace App\Support;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubmissionPage
{
    public static function normalize(?string $source): ?string
    {
        if ($source === null || trim($source) === '') {
            return null;
        }

        $path = parse_url(trim($source), PHP_URL_PATH);
        if (! is_string($path)) {
            return null;
        }

        $path = trim(preg_replace('/\.html?$/i', '', $path), '/');
        if ($path === '' || in_array(strtolower($path), ['home', 'index'], true)) {
            return 'home';
        }

        if (strlen($path) > 255 || ! preg_match('~^[a-zA-Z0-9_-]+(?:/[a-zA-Z0-9_-]+)*$~', $path)) {
            return null;
        }

        if (in_array(strtolower($path), ['unknown', 'unknown-page'], true)) {
            return null;
        }

        return $path;
    }

    public static function capture(Request $request, Form $form): ?string
    {
        $source = self::normalize($request->input('page_source'));
        if ($source !== null) {
            return $source;
        }

        $referer = $request->headers->get('referer');
        if ($referer && parse_url($referer, PHP_URL_HOST) === $request->getHost()) {
            $source = self::normalize($referer);
            if ($source !== null) {
                return $source;
            }
        }

        return self::normalize($form->page?->slug);
    }

    public static function label(?string $source): string
    {
        $source = self::normalize($source);
        if ($source === null) {
            return 'Unknown page';
        }

        return collect(explode('/', $source))
            ->map(fn (string $segment): string => Str::headline($segment))
            ->implode(' / ');
    }
}
