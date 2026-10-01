<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'video_url',
        'tags',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'is_published' => 'boolean',
        ];
    }

    public function thumbnailUrl(): ?string
    {
        return PageSection::resolveImage($this->thumbnail);
    }
}
