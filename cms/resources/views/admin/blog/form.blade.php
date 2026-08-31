@extends('admin.layout-material')

@section('content')
<h2 class="mb-4">{{ isset($post) ? 'Edit Post' : 'New Blog Post' }}</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($post) ? route('admin.blog.update', $post) : route('admin.blog.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($post)) @method('PUT') @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt (Short Summary)</label>
                        <textarea name="excerpt" id="excerpt" class="form-control" rows="3" maxlength="500">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                        <small class="text-muted">Optional. Shows in blog listing.</small>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" class="form-control" rows="10" required>{{ old('content', $post->content ?? '') }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border">
                        <div class="card-body">
                            <h6 class="card-title">Post Settings</h6>

                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $post->author ?? 'Admin') }}">
                            </div>

                            <div class="mb-3">
                                <label for="featured_image" class="form-label">Featured Image</label>
                                @if(isset($post) && $post->featured_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="max-height: 150px; border-radius: 4px; width: 100%;">
                                    </div>
                                @endif
                                <input type="file" name="featured_image" id="featured_image" class="form-control" accept="image/*">
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" name="is_published" id="is_published" class="form-check-input" value="1" {{ old('is_published', $post->is_published ?? false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">
                                    Publish Now
                                </label>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> {{ isset($post) ? 'Update' : 'Create' }} Post
                                </button>
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
