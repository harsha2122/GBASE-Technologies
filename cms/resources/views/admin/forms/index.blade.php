@extends('admin.layout')
@section('title', 'Forms')
@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h1>Forms</h1>
        <a href="{{ route('admin.forms.create') }}" class="btn">+ New Form</a>
    </div>

    <div class="card-box">
        <table>
            <thead><tr><th>Name</th><th>Key</th><th>Fields</th><th>Submissions</th><th></th></tr></thead>
            <tbody>
                @foreach ($forms as $form)
                    <tr>
                        <td>{{ $form->name }}</td>
                        <td>{{ $form->key }}</td>
                        <td>{{ $form->fields_count }}</td>
                        <td><a href="{{ route('admin.forms.submissions.index', $form) }}">{{ $form->submissions_count }} &rarr;</a></td>
                        <td><a href="{{ route('admin.forms.edit', $form) }}">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
