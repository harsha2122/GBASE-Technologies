@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Blog & Articles</h2>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Post
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>
                            <strong>{{ Str::limit($post->title, 40) }}</strong>
                            <br>
                            <small class="text-muted">/blog/{{ $post->slug }}</small>
                        </td>
                        <td>{{ $post->author ?? 'Admin' }}</td>
                        <td>{{ $post->published_at?->format('M d, Y') ?? 'Draft' }}</td>
                        <td>{{ $post->views }}</td>
                        <td>
                            @if($post->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-secondary">Draft</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.blog.destroy', $post) }}" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No blog posts yet. <a href="{{ route('admin.blog.create') }}">Create one</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $posts->links() }}
</div>
@endsection
