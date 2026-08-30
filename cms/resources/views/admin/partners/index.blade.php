@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Partners & Logos</h2>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Partner
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th style="width: 80px;">Logo</th>
                    <th>Name</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Order</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($partners as $partner)
                    <tr>
                        <td>
                            @if($partner->logo_path)
                                <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}" style="max-height: 50px; border-radius: 4px;">
                            @endif
                        </td>
                        <td><strong>{{ $partner->name }}</strong></td>
                        <td>
                            @if($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" class="text-decoration-none">Visit Site →</a>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($partner->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td><span class="badge bg-light text-dark">{{ $partner->sort_order }}</span></td>
                        <td>
                            <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form method="POST" action="{{ route('admin.partners.destroy', $partner) }}" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this partner?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No partners yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $partners->links() }}
</div>
@endsection
