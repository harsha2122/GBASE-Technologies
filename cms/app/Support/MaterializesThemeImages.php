<?php

namespace App\Support;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Copies a theme asset image path onto the `public` disk, so Filament's
 * FileUpload component (which can only preview files it manages on disk)
 * can natively preview seeded default images.
 */
trait MaterializesThemeImages
{
    private function copyImageToPublicDisk(string $relativePublicPath, string $directory): string
    {
        $sourcePath = public_path($relativePublicPath);

        if (! File::exists($sourcePath)) {
            return $relativePublicPath;
        }

        $storagePath = "{$directory}/".basename($relativePublicPath);

        if (! Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->put($storagePath, File::get($sourcePath));
        }

        return $storagePath;
    }
}
