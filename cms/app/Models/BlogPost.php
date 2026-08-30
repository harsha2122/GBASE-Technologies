<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['slug', 'title', 'excerpt', 'content', 'featured_image', 'author', 'views', 'published_at', 'is_published'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    public function incrementViews(): void
    {
        $this->increment('views');
    }
}
