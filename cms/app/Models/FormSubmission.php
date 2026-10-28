<?php

namespace App\Models;

use App\Support\SubmissionPage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormSubmission extends Model
{
    protected $fillable = ['form_id', 'page_source', 'ip_address', 'email_sent'];

    protected $casts = ['email_sent' => 'boolean'];

    /**
     * @return array{label: string, path: ?string, inferred: bool}
     */
    public function sourcePage(): array
    {
        $recorded = SubmissionPage::normalize($this->page_source);
        $source = $recorded ?? SubmissionPage::normalize($this->form?->page?->slug);

        return [
            'label' => SubmissionPage::label($source),
            'path' => $source === null ? null : ($source === 'home' ? '/' : '/'.$source),
            'inferred' => $recorded === null && $source !== null,
        ];
    }

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function values(): HasMany
    {
        return $this->hasMany(FormSubmissionValue::class);
    }
}
