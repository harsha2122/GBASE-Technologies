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
        return match (true) {
            $this->slug === 'home' => url('/'),
            $this->slug === 'spare-parts' => url('/spare_parts.html'),
            $this->slug === 'freezing-landing' => url('/freezing.html'),
            $this->slug === 'heating-landing' => url('/heating.html'),
            str_starts_with($this->slug, 'service-') => url('/service/'.substr($this->slug, strlen('service-')).'.html'),
            str_starts_with($this->slug, 'freezing-') => url('/freezing/'.substr($this->slug, strlen('freezing-')).'.html'),
            str_starts_with($this->slug, 'heating-') => url('/heating/'.substr($this->slug, strlen('heating-')).'.html'),
            $this->slug === 'process-more-machines' => url('/process/more_machines.html'),
            str_starts_with($this->slug, 'process-') => url('/process/'.substr($this->slug, strlen('process-')).'.html'),
            str_starts_with($this->slug, 'sorting-') => url('/sorting/'.substr($this->slug, strlen('sorting-')).'.html'),
            default => url("/{$this->slug}.html"),
        };
    }
}
