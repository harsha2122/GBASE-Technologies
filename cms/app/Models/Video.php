<?php

namespace App\Models;

use App\Support\VideoPlayer;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'video_url',
        'video_urls',
        'tags',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'video_urls' => 'array',
            'is_published' => 'boolean',
        ];
    }

    /** @return array<int, string> */
    public function urls(): array
    {
        $urls = $this->video_urls ?? ($this->video_url ? [$this->video_url] : []);

        return array_values(array_filter($urls, fn ($url): bool => is_string($url) && VideoPlayer::source($url) !== null));
    }

    public function thumbnailUrl(): ?string
    {
        return PageSection::resolveImage($this->thumbnail);
    }
}
