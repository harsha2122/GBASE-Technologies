@extends('admin.layout-material')
@section('title', 'Submission Detail')
@section('content')
    <h1>Submission #{{ $submission->id }}</h1>
    <p><strong>Page:</strong> {{ $submission->page_source }}<br>
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
