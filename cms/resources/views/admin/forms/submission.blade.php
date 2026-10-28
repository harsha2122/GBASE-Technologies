@extends('admin.layout-material')
@section('title', 'Submission Detail')
@section('content')
    <h1>Submission #{{ $submission->id }}</h1>
    <div class="mb-3">
        <strong>Source page:</strong>
        <x-submission-page :submission="$submission" />
    </div>
    <p><strong>Form:</strong> {{ $form->name }}<br>
       <strong>Date:</strong> {{ $submission->created_at->format('Y-m-d H:i') }}</p>

    <div class="card-box">
        <table>
            @foreach ($submission->values as $value)
                <tr>
                    <th style="width:200px;">{{ $value->field->label }}</th>
                    <td>{{ $value->value }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <a href="{{ route('admin.forms.submissions.index', $form) }}">&larr; Back to submissions</a>
@endsection
