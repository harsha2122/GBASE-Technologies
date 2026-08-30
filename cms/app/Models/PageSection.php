<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageSection extends Model
{
    protected $fillable = ['page_id', 'key', 'type', 'heading', 'body', 'image_path', 'sort_order'];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class)->orderBy('sort_order');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class)->orderBy('sort_order');
    }
}
