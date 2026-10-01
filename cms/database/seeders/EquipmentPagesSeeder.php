<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Support\EquipmentPagesSections;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EquipmentPagesSeeder extends Seeder
{
    private const IMAGE_KEYS = ['image', 'icon'];

    public function run(): void
    {
        foreach (EquipmentPagesSections::pages() as $definition) {
            $page = Page::updateOrCreate(
                ['slug' => $definition['slug']],
                [
                    'title' => $definition['title'],
                    'meta_title' => $definition['meta_title'],
                    'meta_description' => $definition['meta_description'],
                    'is_published' => true,
                ]
            );

            $page->sections()->updateOrCreate(
                ['section_key' => 'page_header'],
                [
                    'section_type' => 'page_header',
                    'label' => 'Page Header',
                    'sort_order' => 0,
                    'is_active' => true,
                    'content' => $definition['header'],
                ]
            );

            $page->sections()->updateOrCreate(
                ['section_key' => 'equipment_cards'],
                [
                    'section_type' => 'equipment_cards',
                    'label' => 'Equipment Cards',
                    'sort_order' => 1,
                    'is_active' => true,
                    'content' => $this->materializeImages($definition['cards'], $definition['slug']),
                ]
            );
        }
    }

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
