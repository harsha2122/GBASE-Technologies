<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'meta_title',
        'meta_description',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
        ];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    /**
     * The live public URL for this page. Slugs don't always match the
     * historical .html path (kept for SEO/bookmarks), so map explicitly.
     */
    public function publicUrl(): string
    {
        return match ($this->slug) {
            'home' => url('/'),
            'spare-parts' => url('/spare_parts.html'),
            default => url("/{$this->slug}.html"),
        };
    }
}
