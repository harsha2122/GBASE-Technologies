<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Support\MaterializesThemeImages;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    use MaterializesThemeImages;

    public function run(): void
    {
        Setting::query()->updateOrCreate(['id' => 1], [
            'site_logo' => $this->copyImageToPublicDisk('/images/logo/logo.png', 'branding'),
            'topbar_phone' => '+91 9810384249',
            'topbar_email' => 'info@gbase.co.in',
            'whatsapp_number' => '919315738621',
            'float_call_number' => '+91 9878640088',
            'facebook_url' => 'https://www.facebook.com/gbasetechnologies/',
            'instagram_url' => 'https://www.instagram.com/gbasetechnologies/',
            'youtube_url' => 'https://www.youtube.com/@gbasetechnologies',
            'linkedin_url' => 'https://www.linkedin.com/company/gbase-technologiesfoodprocessingmachineries/',
            'footer_about_text' => 'GBASE Technologies was established in 2004. Happy customers in Australia, Bangladesh, India, Indonesia, New Zealand and Sri Lanka.',
        ]);
    }
}
