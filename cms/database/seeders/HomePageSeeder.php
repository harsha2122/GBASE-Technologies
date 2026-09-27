<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Support\HomeSections;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class HomePageSeeder extends Seeder
{
    private const IMAGE_KEYS = ['image', 'icon'];

    public function run(): void
    {
        $page = Page::updateOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'meta_title' => 'GBASE Technologies | Food Processing Equipment',
                'meta_description' => 'GBASE Technologies specializes in designing and implementing projects for horticulture produce — covering fruits, vegetables, herbs, meat, poultry, dairy, seafood, and grains.',
                'is_published' => true,
            ]
        );

        foreach (HomeSections::definitions() as $order => $section) {
            $content = $this->materializeImages($section['content'], $section['section_key']);

            $page->sections()->updateOrCreate(
                ['section_key' => $section['section_key']],
                [
                    'section_type' => $section['section_type'],
                    'label' => $section['label'],
                    'sort_order' => $order,
                    'is_active' => true,
                    'content' => $content,
                ]
            );
        }
    }

    /**
     * Recursively walks a section's content array and copies any
     * theme asset image path onto the `public` disk, rewriting the
     * value to the new storage-relative path. This lets Filament's
     * FileUpload component natively preview the seeded default
     * images, since it can only preview files it manages on disk.
     */
    private function materializeImages(array $content, string $sectionKey): array
    {
        foreach ($content as $key => $value) {
            if (is_array($value)) {
                $content[$key] = $this->materializeImages($value, $sectionKey);

                continue;
            }

            if (! in_array($key, self::IMAGE_KEYS, true) || ! is_string($value)) {
                continue;
            }

            $content[$key] = $this->copyToPublicDisk($value, $sectionKey);
        }

        return $content;
    }

    private function copyToPublicDisk(string $relativePublicPath, string $sectionKey): string
    {
        $sourcePath = public_path($relativePublicPath);

        if (! File::exists($sourcePath)) {
            return $relativePublicPath;
        }

        $storagePath = "sections/{$sectionKey}/".basename($relativePublicPath);

        if (! Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->put($storagePath, File::get($sourcePath));
        }

        return $storagePath;
    }
}
