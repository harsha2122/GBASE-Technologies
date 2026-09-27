<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class PageSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_key',
        'section_type',
        'label',
        'sort_order',
        'is_active',
        'content',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Resolves an image field's value to a browsable URL.
     * Content may hold either an uploaded storage path (new)
     * or the original theme's public asset path (untouched by an editor).
     */
    public static function resolveImage(string|array|null $value): ?string
    {
        if (is_array($value)) {
            $value = collect($value)->first();
        }

        if (blank($value)) {
            return null;
        }

        if (Storage::disk('public')->exists($value)) {
            return Storage::disk('public')->url($value);
        }

        return str_starts_with($value, '/') ? $value : '/'.$value;
    }
}
