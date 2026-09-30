<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'topbar_phone',
        'topbar_email',
        'whatsapp_number',
        'float_call_number',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'linkedin_url',
        'footer_about_text',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1]);
    }
}
