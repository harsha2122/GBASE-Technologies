<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'tags',
        'author_name',
        'published_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Article $article) {
            if (blank($article->slug)) {
                $article->slug = Str::slug($article->title);
            }

            if (blank($article->published_at) && $article->is_published) {
                $article->published_at = now();
            }
        });
    }

    public function imageUrl(): ?string
    {
        return PageSection::resolveImage($this->featured_image);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
