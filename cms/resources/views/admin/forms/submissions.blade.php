@extends('admin.layout-material')
@section('title', $form->name . ' — Submissions')
@section('content')
    <h1>{{ $form->name }} — Submissions</h1>

    <div class="card-box">
        <table>
            <thead><tr><th>Date</th><th>Page</th><th>Emailed</th><th></th></tr></thead>
            <tbody>
                @foreach ($submissions as $submission)
                    <tr>
                        <td>{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                        <td>{{ $submission->page_source }}</td>
                        <td>{{ $submission->email_sent ? 'Yes' : 'No' }}</td>
                        <td><a href="{{ route('admin.forms.submissions.show', [$form, $submission]) }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $submissions->links() }}
@endsection
