<?php

namespace Database\Seeders;

use App\Models\PageView;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageViewSeeder extends Seeder
{
    public function run(): void
    {
        $paths = ['/', '/equipments.html', '/contact.html', '/process/used-equipments.html', '/knowledge-articles.html', '/consulting.html'];
        $devices = ['desktop', 'desktop', 'desktop', 'mobile', 'mobile', 'tablet'];
        $browsers = ['Chrome', 'Safari', 'Edge', 'Firefox'];
        $platforms = ['Windows', 'OS X', 'Android', 'iOS'];

        for ($day = 13; $day >= 0; $day--) {
            $date = today()->subDays($day);
            $visitCount = rand(15, 60);

            for ($i = 0; $i < $visitCount; $i++) {
                PageView::create([
                    'path' => $paths[array_rand($paths)],
                    'visitor_id' => (string) Str::uuid(),
                    'session_id' => (string) Str::uuid(),
                    'referrer' => rand(0, 1) ? 'https://www.google.com/' : null,
                    'device_type' => $devices[array_rand($devices)],
                    'browser' => $browsers[array_rand($browsers)],
                    'platform' => $platforms[array_rand($platforms)],
                    'viewed_at' => $date->copy()->addMinutes(rand(0, 1439)),
                ]);
            }
        }
    }
}
