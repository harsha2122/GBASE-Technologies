@extends('admin.layout')

@section('content')
<h2 class="mb-4">{{ isset($gallery) ? 'Edit Image' : 'Add Gallery Image' }}</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($gallery) ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($gallery)) @method('PUT') @endif

            <div class="mb-3">
                <label for="page_section_id" class="form-label">Associated Section (Optional)</label>
                <select name="page_section_id" id="page_section_id" class="form-select">
                    <option value="">-- General Gallery --</option>
                    @foreach($sections as $section)
                        <option value="{{ $section->id }}" {{ old('page_section_id', $gallery->page_section_id ?? null) == $section->id ? 'selected' : '' }}>
                            {{ $section->page->title }} - {{ $section->type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if(isset($gallery) && $gallery->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->alt_text }}" style="max-height: 200px; border-radius: 4px;">
                    </div>
                @endif
                <input type="file" name="image" id="image" class="form-control" {{ isset($gallery) ? '' : 'required' }} accept="image/*">
                <small class="text-muted">Max 5MB. Supported: JPG, PNG, GIF</small>
            </div>

            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <input type="text" name="caption" id="caption" class="form-control" value="{{ old('caption', $gallery->caption ?? '') }}" maxlength="255">
            </div>

            <div class="mb-3">
                <label for="alt_text" class="form-label">Alt Text (for SEO)</label>
                <input type="text" name="alt_text" id="alt_text" class="form-control" value="{{ old('alt_text', $gallery->alt_text ?? '') }}" maxlength="255">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($gallery) ? 'Update' : 'Add' }} Image
                </button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
