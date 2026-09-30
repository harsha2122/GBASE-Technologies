<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Support\SimplePagesSections;
use Illuminate\Database\Seeder;

class SimplePagesSeeder extends Seeder
{
    public function run(): void
    {
        foreach (SimplePagesSections::pages() as $pageDefinition) {
            $page = Page::updateOrCreate(
                ['slug' => $pageDefinition['slug']],
                [
                    'title' => $pageDefinition['title'],
                    'meta_title' => $pageDefinition['meta_title'],
                    'meta_description' => $pageDefinition['meta_description'],
                    'is_published' => true,
                ]
            );

            foreach ($pageDefinition['sections'] as $order => $section) {
                $page->sections()->updateOrCreate(
                    ['section_key' => $section['section_key']],
                    [
                        'section_type' => $section['section_type'],
                        'label' => $section['label'],
                        'sort_order' => $order,
                        'is_active' => true,
                        'content' => $section['content'],
                    ]
                );
            }
        }
    }
}
