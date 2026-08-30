<?php

namespace App\Http\Controllers;

use App\Mail\FormSubmissionReceived;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\FormSubmissionValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Generic handler for every form on the site. A form's shape lives
 * entirely in form_fields, so adding a field or a whole new form never
 * requires touching this controller.
 */
class FormSubmitController extends Controller
{
    public function store(Request $request, Form $form)
    {
        $form->load('fields');

        $rules = [];
        foreach ($form->fields as $field) {
            $fieldRules = [];
            $fieldRules[] = $field->is_required ? 'required' : 'nullable';
            $fieldRules[] = match ($field->type) {
                'email' => 'email',
                'file' => 'file|max:4096',
                default => 'string',
            };
            $rules[$field->name] = $fieldRules;
        }

        $validated = $request->validate($rules);

        $submission = FormSubmission::create([
            'form_id' => $form->id,
            'page_source' => $request->input('page_source'),
            'ip_address' => $request->ip(),
        ]);

        foreach ($form->fields as $field) {
            $value = $field->type === 'file'
                ? ($request->hasFile($field->name) ? $request->file($field->name)->store('submissions', 'public') : null)
                : ($validated[$field->name] ?? null);

            FormSubmissionValue::create([
                'form_submission_id' => $submission->id,
                'form_field_id' => $field->id,
                'value' => $value,
            ]);
        }

        try {
            Mail::to($form->notify_email)->send(new FormSubmissionReceived($submission));
            $submission->update(['email_sent' => true]);
        } catch (\Throwable $e) {
            Log::error('Form submission email failed: ' . $e->getMessage());
        }

        return response()->json([
            'success' => true,
            'message' => 'Thank you! Your message has been sent. We will get back to you shortly.',
        ]);
    }
}
