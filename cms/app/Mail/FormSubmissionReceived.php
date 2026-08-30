<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmissionReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public FormSubmission $submission)
    {
    }

    public function build()
    {
        $submission = $this->submission->load('values.field', 'form');
        $pageLabel = $this->humanizePageSource($submission->page_source);

        return $this
            ->subject("GBASE Enquiry [{$pageLabel}] — {$submission->form->name}")
            ->markdown('emails.form-submission')
            ->with([
                'submission' => $submission,
                'pageLabel' => $pageLabel,
            ]);
    }

    private function humanizePageSource(?string $raw): string
    {
        if (empty($raw)) {
            return 'Unknown page';
        }
        $path = preg_replace('/\.html?$/i', '', $raw);
        $segments = array_filter(explode('/', $path), fn ($s) => $s !== '');
        $labels = array_map(function ($segment) {
            $words = preg_split('/[-_]+/', $segment);
            return implode(' ', array_map('ucfirst', $words));
        }, $segments);
        return implode(' - ', $labels) ?: 'Unknown page';
    }
}
