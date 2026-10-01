<?php

namespace Database\Seeders;

use App\Models\Video;
use App\Support\MaterializesThemeImages;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    use MaterializesThemeImages;

    public function run(): void
    {
        $videos = [
            [
                'title' => 'IQF Line Overview',
                'description' => 'A quick look at airflow, belt handling, and cooling consistency.',
                'thumbnail' => '/images/project/IQF.png',
                'tags' => ['IQF', 'Overview'],
                'sort_order' => 1,
            ],
            [
                'title' => 'Maintenance Checklist',
                'description' => 'Daily checks that keep your line running smoothly.',
                'thumbnail' => '/images/product/geo.png',
                'tags' => ['Round Fruit Sorting'],
                'sort_order' => 2,
            ],
            [
                'title' => 'Troubleshooting Basics',
                'description' => 'Common causes of uneven freezing and how to fix them.',
                'thumbnail' => '/images/product/6.png',
                'tags' => ['Cutting, Dicing & Slicing'],
                'sort_order' => 3,
            ],
        ];

        foreach ($videos as $video) {
            Video::updateOrCreate(
                ['title' => $video['title']],
                [
                    'description' => $video['description'],
                    'thumbnail' => $this->copyImageToPublicDisk($video['thumbnail'], 'videos'),
                    'tags' => $video['tags'],
                    'sort_order' => $video['sort_order'],
                    'is_published' => true,
                ]
            );
        }
    }
}
