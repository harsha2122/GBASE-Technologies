<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::withCount('fields', 'submissions')->orderBy('name')->get();
        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        return view('admin.forms.form', ['form' => new Form()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:255', 'unique:forms,key'],
            'name' => ['required', 'string', 'max:255'],
            'page_id' => ['nullable', 'exists:pages,id'],
            'notify_email' => ['required', 'email'],
            'submit_button_text' => ['nullable', 'string', 'max:100'],
        ]);

        $form = Form::create($data);

        return redirect()->route('admin.forms.edit', $form)->with('status', 'Form created.');
    }

    public function edit(Form $form)
    {
        $form->load('fields');
        return view('admin.forms.form', compact('form'));
    }

    public function update(Request $request, Form $form)
    {
        $data = $request->validate([
            'key' => ['required', 'string', 'max:255', 'unique:forms,key,' . $form->id],
            'name' => ['required', 'string', 'max:255'],
            'page_id' => ['nullable', 'exists:pages,id'],
            'notify_email' => ['required', 'email'],
            'submit_button_text' => ['nullable', 'string', 'max:100'],
        ]);

        $form->update($data);

        return back()->with('status', 'Form updated.');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.forms.index')->with('status', 'Form deleted.');
    }

    public function storeField(Request $request, Form $form)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9_]+$/'],
            'label' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:text,email,tel,textarea,select,checkbox,file'],
            'options' => ['nullable', 'string'],
            'is_required' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['form_id'] = $form->id;
        $data['is_required'] = $request->boolean('is_required');
        $data['sort_order'] = $data['sort_order'] ?? ($form->fields()->max('sort_order') + 1);
        $data['options'] = $data['options']
            ? array_map('trim', explode(',', $data['options']))
            : null;

        FormField::create($data);

        return back()->with('status', 'Field added.');
    }

    public function updateField(Request $request, Form $form, FormField $field)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'regex:/^[a-z0-9_]+$/'],
            'label' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:text,email,tel,textarea,select,checkbox,file'],
            'options' => ['nullable', 'string'],
            'is_required' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['is_required'] = $request->boolean('is_required');
        $data['options'] = $data['options']
            ? array_map('trim', explode(',', $data['options']))
            : null;

        $field->update($data);

        return back()->with('status', 'Field updated.');
    }

    public function destroyField(Form $form, FormField $field)
    {
        $field->delete();
        return back()->with('status', 'Field deleted.');
    }
}
