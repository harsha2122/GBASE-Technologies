@extends('admin.layout-material')
@section('title', $form->exists ? 'Edit Form' : 'New Form')
@section('content')
    <h1>{{ $form->exists ? 'Edit Form: ' . $form->name : 'New Form' }}</h1>

    <div class="card-box">
        <form method="POST" action="{{ $form->exists ? route('admin.forms.update', $form) : route('admin.forms.store') }}">
            @csrf
            @if ($form->exists) @method('PUT') @endif

            <label>Key (used in the page template, e.g. used-equipment-enquiry)</label>
            <input type="text" name="key" value="{{ old('key', $form->key) }}" required>

            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $form->name) }}" required>

            <label>Notify Email</label>
            <input type="email" name="notify_email" value="{{ old('notify_email', $form->notify_email) }}" required>

            <label>Submit Button Text</label>
            <input type="text" name="submit_button_text" value="{{ old('submit_button_text', $form->submit_button_text ?? 'Submit') }}">

            <button type="submit">Save</button>
        </form>
    </div>

    @if ($form->exists)
        <div class="card-box">
            <h2>Fields</h2>
            <table>
                <thead><tr><th>Name</th><th>Label</th><th>Type</th><th>Required</th><th></th></tr></thead>
                <tbody>
                    @foreach ($form->fields as $field)
                        <tr>
                            <td>{{ $field->name }}</td>
                            <td>{{ $field->label }}</td>
                            <td>{{ $field->type }}</td>
                            <td>{{ $field->is_required ? 'Yes' : 'No' }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.forms.fields.destroy', [$form, $field]) }}" onsubmit="return confirm('Delete this field?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3 style="margin-top:1.5rem;">Add Field</h3>
            <form method="POST" action="{{ route('admin.forms.fields.store', $form) }}">
                @csrf
                <label>Name (lowercase, no spaces — e.g. company)</label>
                <input type="text" name="name" pattern="[a-z0-9_]+" required>
                <label>Label</label>
                <input type="text" name="label" required>
                <label>Type</label>
                <select name="type">
                    <option value="text">text</option>
                    <option value="email">email</option>
                    <option value="tel">tel</option>
                    <option value="textarea">textarea</option>
                    <option value="select">select</option>
                    <option value="checkbox">checkbox</option>
                    <option value="file">file</option>
                </select>
                <label>Options (comma-separated, for select fields only)</label>
                <input type="text" name="options" placeholder="Option A, Option B, Option C">
                <label><input type="checkbox" name="is_required" value="1" style="width:auto;"> Required</label>
                <button type="submit">Add Field</button>
            </form>
        </div>
    @endif
@endsection
