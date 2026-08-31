@extends('admin.layout-material')

@section('content')
<div class="container-fluid px-4">
    <h1 class="h2 mb-4">Dashboard</h1>

    <!-- Stats Row -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Total Pages</p>
                            <h3 class="mb-0">{{ $stats['total_pages'] }}</h3>
                        </div>
                        <span class="badge bg-primary">{{ $stats['published_pages'] }} Published</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Form Submissions</p>
                            <h3 class="mb-0">{{ $stats['total_submissions'] }}</h3>
                        </div>
                        <span class="badge bg-success">{{ $stats['total_forms'] }} Forms</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Blog Posts</p>
                            <h3 class="mb-0">{{ $stats['total_blog_posts'] }}</h3>
                        </div>
                        <span class="badge bg-info">{{ $stats['published_blogs'] }} Live</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <p class="text-muted mb-1">Partners</p>
                            <h3 class="mb-0">{{ $stats['total_partners'] }}</h3>
                        </div>
                        <span class="badge bg-warning">{{ $stats['active_partners'] }} Active</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Gallery Images</h5>
                    <div class="display-6 text-primary">{{ $stats['total_galleries'] }}</div>
                    <small class="text-muted">Total images uploaded</small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Quick Links</h5>
                    <div class="btn-group-vertical w-100" role="group">
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary text-start">→ Manage Pages</a>
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-primary text-start">→ Gallery</a>
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-primary text-start">→ Blog Posts</a>
                        <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-primary text-start">→ Partners</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Submissions -->
    <div class="row g-3">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">Recent Form Submissions</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Form</th>
                                <th>Page Source</th>
                                <th>Email</th>
                                <th>Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stats['recent_submissions'] as $submission)
                                <tr>
                                    <td><strong>{{ $submission->form->name }}</strong></td>
                                    <td>{{ $submission->page_source }}</td>
                                    <td>
                                        @php
                                            $emailValue = $submission->values()
                                                ->whereHas('field', function($q) { $q->where('type', 'email'); })
                                                ->first()?->value ?? 'N/A';
                                        @endphp
                                        {{ $emailValue }}
                                    </td>
                                    <td><small>{{ $submission->created_at->diffForHumans() }}</small></td>
                                    <td>
                                        <a href="{{ route('admin.forms.submissions.show', [$submission->form, $submission]) }}" class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No submissions yet</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
