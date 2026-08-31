@extends('admin.layout-material')

@section('content')
<div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> New Page
    </a>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card success">
        <div class="stat-label">Total Pages</div>
        <div class="stat-value">{{ $stats['total_pages'] }}</div>
        <div class="stat-change">{{ $stats['published_pages'] }} published</div>
    </div>

    <div class="stat-card info">
        <div class="stat-label">Form Submissions</div>
        <div class="stat-value">{{ $stats['total_submissions'] }}</div>
        <div class="stat-change">From {{ $stats['total_forms'] }} forms</div>
    </div>

    <div class="stat-card warning">
        <div class="stat-label">Blog Posts</div>
        <div class="stat-value">{{ $stats['total_blog_posts'] }}</div>
        <div class="stat-change">{{ $stats['published_blogs'] }} live</div>
    </div>

    <div class="stat-card">
        <div class="stat-label">Partners</div>
        <div class="stat-value">{{ $stats['total_partners'] }}</div>
        <div class="stat-change">{{ $stats['active_partners'] }} active</div>
    </div>

    <div class="stat-card success">
        <div class="stat-label">Gallery Images</div>
        <div class="stat-value">{{ $stats['total_galleries'] }}</div>
        <div class="stat-change">Organized & tagged</div>
    </div>

    <div class="stat-card error">
        <div class="stat-label">Today's Submissions</div>
        <div class="stat-value">{{ $stats['today_submissions'] ?? 0 }}</div>
        <div class="stat-change">Last 24 hours</div>
    </div>
</div>

<!-- Quick Actions & Recent Activity -->
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Quick Actions -->
    <div class="card">
        <div class="card-header">Quick Actions</div>
        <div class="card-body">
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary" style="justify-content: flex-start;">
                    <i class="fas fa-file-plus"></i> Create Page
                </a>
                <a href="{{ route('admin.gallery.create') }}" class="btn btn-secondary" style="justify-content: flex-start;">
                    <i class="fas fa-image"></i> Add Image
                </a>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-secondary" style="justify-content: flex-start;">
                    <i class="fas fa-pen"></i> Write Blog
                </a>
                <a href="{{ route('admin.partners.create') }}" class="btn btn-secondary" style="justify-content: flex-start;">
                    <i class="fas fa-link"></i> Add Partner
                </a>
                <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary" style="justify-content: flex-start;">
                    <i class="fas fa-sliders-h"></i> Settings
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Submissions -->
    <div class="card">
        <div class="card-header">Recent Form Submissions</div>
        <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Form</th>
                            <th>Submitted</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['recent_submissions'] as $submission)
                            <tr>
                                <td>
                                    <strong style="color: var(--primary);">{{ $submission->form->name }}</strong>
                                </td>
                                <td>
                                    <small style="color: var(--text-secondary);">
                                        {{ $submission->created_at->format('M d, H:i') }}
                                    </small>
                                </td>
                                <td>
                                    <span class="badge {{ $submission->email_sent ? 'success' : 'warning' }}">
                                        {{ $submission->email_sent ? 'Sent' : 'Pending' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.forms.submissions.show', [$submission->form, $submission]) }}" class="btn btn-sm" style="background: var(--primary); color: white; border: none;">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center; color: var(--text-secondary); padding: 2rem;">
                                    No submissions yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Content Summary -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
    <!-- Pages Summary -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-file-alt"></i> Pages Management
        </div>
        <div class="card-body">
            <p style="color: var(--text-secondary); margin-bottom: 1rem;">
                Manage your website pages, sections, and content structure.
            </p>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-primary" style="width: 100%; justify-content: center;">
                Manage Pages →
            </a>
        </div>
    </div>

    <!-- Blog Summary -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-newspaper"></i> Blog & Articles
        </div>
        <div class="card-body">
            <p style="color: var(--text-secondary); margin-bottom: 1rem;">
                Create and publish articles to engage your audience.
            </p>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-primary" style="width: 100%; justify-content: center;">
                View Blog →
            </a>
        </div>
    </div>

    <!-- Forms Summary -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-wpforms"></i> Forms & Submissions
        </div>
        <div class="card-body">
            <p style="color: var(--text-secondary); margin-bottom: 1rem;">
                Manage contact forms and view all submissions.
            </p>
            <a href="{{ route('admin.forms.index') }}" class="btn btn-primary" style="width: 100%; justify-content: center;">
                View Forms →
            </a>
        </div>
    </div>
</div>
@endsection
