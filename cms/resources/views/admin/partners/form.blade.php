@extends('admin.layout-material')

@section('content')
<h2 class="mb-4">{{ isset($partner) ? 'Edit Partner' : 'Add New Partner' }}</h2>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ isset($partner) ? route('admin.partners.update', $partner) : route('admin.partners.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($partner)) @method('PUT') @endif

            <div class="mb-3">
                <label for="name" class="form-label">Partner Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $partner->name ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                @if(isset($partner) && $partner->logo_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" style="max-height: 100px; border-radius: 4px;">
                    </div>
                @endif
                <input type="file" name="logo" id="logo" class="form-control" {{ isset($partner) ? '' : 'required' }} accept="image/*">
                <small class="text-muted">Max 2MB. Recommended: PNG with transparent background</small>
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Website URL</label>
                <input type="url" name="website" id="website" class="form-control" value="{{ old('website', $partner->website ?? '') }}" placeholder="https://...">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3" maxlength="500">{{ old('description', $partner->description ?? '') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Display Order</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control" value="{{ old('sort_order', $partner->sort_order ?? 0) }}" min="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check mt-4">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active (Show on website)
                        </label>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ isset($partner) ? 'Update' : 'Add' }} Partner
                </button>
                <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
