<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormSubmission;

class FormSubmissionController extends Controller
{
    public function index(Form $form)
    {
        $submissions = $form->submissions()
            ->with('values.field')
            ->latest()
            ->paginate(25);

        return view('admin.forms.submissions', compact('form', 'submissions'));
    }

    public function show(Form $form, FormSubmission $submission)
    {
        $submission->load('values.field');
        return view('admin.forms.submission', compact('form', 'submission'));
    }
}
