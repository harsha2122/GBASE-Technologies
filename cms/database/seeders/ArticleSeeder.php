<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Improving Freezing Line Efficiency',
                'excerpt' => 'Reduce product loss and improve throughput with airflow checks and belt tuning.',
                'body' => '<p>Reduce product loss and improve throughput with airflow checks and belt tuning.</p>'
                    .'<p>A freezing line only performs as well as its weakest station. Before chasing exotic fixes, run through the basics: confirm fan speeds and airflow direction match the manufacturer spec, check belt tension and tracking for drift that causes uneven product spacing, and verify that infeed loading is consistent rather than bunched.</p>'
                    .'<p>Most efficiency losses we see in the field trace back to one of three things — airflow short-circuiting around a worn door seal, a belt running slightly off-speed against the compressor duty cycle, or infeed surges that overload one section of the tunnel while starving another. Fixing these usually costs very little and pays back within weeks in reduced product giveaway and energy use.</p>',
                'featured_image' => 'images/project/IQF.png',
                'tags' => ['IQF', 'Performance'],
                'published_at' => Carbon::parse('2026-03-10'),
            ],
            [
                'title' => 'Weekly Maintenance Checklist',
                'excerpt' => 'A simple routine to keep conveyors, bearings, and airflow systems healthy.',
                'body' => '<p>A simple routine to keep conveyors, bearings, and airflow systems healthy.</p>'
                    .'<ul>'
                    .'<li>Inspect belt tension and alignment; adjust before wear becomes visible.</li>'
                    .'<li>Grease bearings on the schedule specified for your duty cycle, not just when noise appears.</li>'
                    .'<li>Clear debris from airflow intakes and check that fan guards are unobstructed.</li>'
                    .'<li>Log any unusual vibration or temperature readings so patterns show up over time.</li>'
                    .'</ul>'
                    .'<p>None of this replaces a full preventive maintenance contract, but a five-minute weekly walk-through catches the majority of issues before they become downtime.</p>',
                'featured_image' => 'images/product/geo.png',
                'tags' => ['Round Fruit Sorting'],
                'published_at' => Carbon::parse('2026-03-08'),
            ],
            [
                'title' => 'Avoiding Uneven Freezing',
                'excerpt' => 'Common causes, quick checks, and the fixes that usually solve it fast.',
                'body' => '<p>Common causes, quick checks, and the fixes that usually solve it fast.</p>'
                    .'<p>Uneven freezing is almost always a symptom of uneven airflow or uneven product loading — rarely a refrigeration capacity problem. Start by checking whether product is spread in a single, consistent layer across the belt width; overlapping pieces freeze at very different rates.</p>'
                    .'<p>Next, check for airflow dead zones, typically near tunnel walls or under-maintained fan sections. A simple smoke test or a few strategically placed temperature probes during a production run will usually reveal the pattern immediately, and the fix is often as simple as a baffle adjustment or a more even infeed spread.</p>',
                'featured_image' => 'images/product/6.png',
                'tags' => ['Cutting, Dicing & Slicing'],
                'published_at' => Carbon::parse('2026-03-05'),
            ],
        ];

        foreach ($articles as $article) {
            Article::updateOrCreate(
                ['title' => $article['title']],
                [
                    'excerpt' => $article['excerpt'],
                    'body' => $article['body'],
                    'featured_image' => $article['featured_image'],
                    'tags' => $article['tags'],
                    'author_name' => 'GBASE Team',
                    'published_at' => $article['published_at'],
                    'is_published' => true,
                ]
            );
        }
    }
}
