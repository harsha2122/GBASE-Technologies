<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmissionReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public FormSubmission $submission) {}

    public function build()
    {
        $submission = $this->submission->load('values.field', 'form.page');
        $sourcePage = $submission->sourcePage();
        $pageLabel = $sourcePage['label'];

        return $this
            ->subject("GBASE Enquiry [{$pageLabel}] — {$submission->form->name}")
            ->markdown('emails.form-submission')
            ->with([
                'submission' => $submission,
                'pageLabel' => $pageLabel,
                'sourcePage' => $sourcePage,
            ]);
    }
}
