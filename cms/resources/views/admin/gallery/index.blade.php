@extends('admin.layout-material')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gallery Management</h2>
    <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Image
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Section</th>
                    <th>Alt Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($galleries as $item)
                    <tr>
                        <td>
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->alt_text }}" style="max-height: 50px; border-radius: 4px;">
                            @endif
                        </td>
                        <td>{{ $item->caption ?? 'N/A' }}</td>
                        <td>{{ $item->section?->page?->title ?? 'General' }}</td>
                        <td>{{ Str::limit($item->alt_text, 30) ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.gallery.edit', $item) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $item) }}" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this image?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No gallery images yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $galleries->links() }}
</div>
@endsection
