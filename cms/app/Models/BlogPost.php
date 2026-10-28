<?php

namespace App\Models;

use App\Support\VideoUrl;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['slug', 'title', 'excerpt', 'content', 'featured_image', 'author', 'views', 'published_at', 'is_published', 'video_urls'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'video_urls' => 'array',
    ];

    /**
     * @return array<int, array{type: string, src: string, url: string, title: string}>
     */
    public function playableVideos(): array
    {
        $videos = [];
        foreach ($this->video_urls ?? [] as $url) {
            $player = is_string($url) ? VideoUrl::player($url) : null;
            if ($player !== null) {
                $videos[] = $player + ['url' => $url, 'title' => 'Video '.(count($videos) + 1)];
            }
        }

        return $videos;
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
