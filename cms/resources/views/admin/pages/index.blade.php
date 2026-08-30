@extends('admin.layout')
@section('title', 'Pages')
@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <h1>Pages</h1>
        <a href="{{ route('admin.pages.create') }}" class="btn">+ New Page</a>
    </div>

    <div class="card-box">
        <table>
            <thead>
                <tr><th>Title</th><th>Slug</th><th>Published</th><th></th></tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                    <tr>
                        <td>{{ $page->title }}</td>
                        <td>/{{ $page->slug }}</td>
                        <td>{{ $page->is_published ? 'Yes' : 'No' }}</td>
                        <td><a href="{{ route('admin.pages.edit', $page) }}">Edit</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $pages->links() }}
@endsection
