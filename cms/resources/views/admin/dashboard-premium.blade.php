@extends('admin.layout-material')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<style>
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .dashboard-title {
        font-size: 2rem;
        font-weight: 300;
        color: var(--text-primary);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.2);
    }

    .stat-card.blue { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .stat-card.green { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .stat-card.orange { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .stat-card.red { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
    .stat-card.purple { background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .stat-card-content {
        position: relative;
        z-index: 1;
    }

    .stat-card-label {
        font-size: 0.85rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        font-weight: 500;
    }

    .stat-card-value {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-card-meta {
        font-size: 0.85rem;
        opacity: 0.8;
    }

    .chart-container {
        position: relative;
        height: 300px;
        margin-bottom: 2rem;
    }

    .row-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
    }

    .chart-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
    }

    .chart-wrapper {
        position: relative;
        height: 300px;
    }

    .table-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        overflow: hidden;
    }

    .table-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--divider);
        font-size: 1.1rem;
        font-weight: 600;
    }

    .table-body {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        background-color: #f5f5f5;
        padding: 1rem 1.5rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.85rem;
        color: var(--text-secondary);
        border-bottom: 2px solid var(--divider);
        text-transform: uppercase;
    }

    .table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--divider);
    }

    .table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.8rem;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.85rem;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .action-btn:hover {
        background: var(--primary-dark);
    }

    .status-badge {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-badge.success {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status-badge.pending {
        background: #fff3e0;
        color: #f57c00;
    }

    .status-badge.danger {
        background: #ffebee;
        color: #c62828;
    }

    .empty-state {
        text-align: center;
        padding: 2rem;
        color: var(--text-secondary);
    }

    @media (max-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
        .row-2 {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Header -->
<div class="dashboard-header">
    <div>
        <h1 class="dashboard-title">Dashboard</h1>
        <p style="color: var(--text-secondary); margin-top: 0.5rem;">Welcome back! Here's your site overview.</p>
    </div>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary" style="padding: 0.8rem 1.5rem; font-size: 1rem;">
        <i class="fas fa-plus"></i> Create Page
    </a>
</div>

<!-- KPI Cards -->
<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-card-content">
            <div class="stat-card-label">Total Pages</div>
            <div class="stat-card-value">{{ $stats['total_pages'] }}</div>
            <div class="stat-card-meta">
                <i class="fas fa-check"></i> {{ $stats['published_pages'] }} published
            </div>
        </div>
    </div>

    <div class="stat-card green">
        <div class="stat-card-content">
            <div class="stat-card-label">Form Submissions</div>
            <div class="stat-card-value">{{ $stats['total_submissions'] }}</div>
            <div class="stat-card-meta">
                <i class="fas fa-chart-line"></i> From {{ $stats['total_forms'] }} forms
            </div>
        </div>
    </div>

    <div class="stat-card orange">
        <div class="stat-card-content">
            <div class="stat-card-label">Blog Posts</div>
            <div class="stat-card-value">{{ $stats['total_blog_posts'] }}</div>
            <div class="stat-card-meta">
                <i class="fas fa-star"></i> {{ $stats['published_blogs'] }} live
            </div>
        </div>
    </div>

    <div class="stat-card red">
        <div class="stat-card-content">
            <div class="stat-card-label">Today</div>
            <div class="stat-card-value">{{ $stats['today_submissions'] ?? 0 }}</div>
            <div class="stat-card-meta">
                <i class="fas fa-clock"></i> New submissions
            </div>
        </div>
    </div>

    <div class="stat-card purple">
        <div class="stat-card-content">
            <div class="stat-card-label">Partners</div>
            <div class="stat-card-value">{{ $stats['total_partners'] }}</div>
            <div class="stat-card-meta">
                <i class="fas fa-check"></i> {{ $stats['active_partners'] }} active
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row-2">
    <!-- Submissions Trend -->
    <div class="chart-card">
        <h3 class="chart-title">
            <i class="fas fa-chart-line"></i> Submissions Trend (30 Days)
        </h3>
        <div class="chart-wrapper">
            <canvas id="submissionsChart"></canvas>
        </div>
    </div>

    <!-- Content Overview -->
    <div class="chart-card">
        <h3 class="chart-title">
            <i class="fas fa-pie-chart"></i> Content Overview
        </h3>
        <div class="chart-wrapper">
            <canvas id="contentChart"></canvas>
        </div>
    </div>
</div>

<!-- Recent Submissions Table -->
<div class="table-card">
    <div class="table-header">
        <i class="fas fa-inbox"></i> Recent Form Submissions
    </div>
    <div class="table-body">
        @if($stats['recent_submissions']->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Form Name</th>
                        <th>Submitted</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_submissions'] as $submission)
                        <tr>
                            <td>
                                <strong>{{ $submission->form->name }}</strong>
                                <br>
                                <small style="color: var(--text-secondary);">{{ $submission->page_source }}</small>
                            </td>
                            <td>
                                <small style="color: var(--text-secondary);">
                                    {{ $submission->created_at->format('M d, Y H:i') }}
                                </small>
                            </td>
                            <td>
                                @if($submission->email_sent)
                                    <span class="status-badge success">
                                        <i class="fas fa-check"></i> Sent
                                    </span>
                                @else
                                    <span class="status-badge pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.forms.submissions.show', [$submission->form, $submission]) }}" class="action-btn">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox" style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem; display: block;"></i>
                <p>No form submissions yet</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Submissions Trend Chart
    const submissionsCtx = document.getElementById('submissionsChart').getContext('2d');
    const dates = {!! json_encode($submission_trend->pluck('date')) !!};
    const counts = {!! json_encode($submission_trend->pluck('count')) !!};

    new Chart(submissionsCtx, {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Submissions',
                data: counts,
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Content Overview Chart
    const contentCtx = document.getElementById('contentChart').getContext('2d');
    new Chart(contentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Pages', 'Blog Posts', 'Gallery', 'Partners'],
            datasets: [{
                data: [
                    {{ $stats['total_pages'] }},
                    {{ $stats['total_blog_posts'] }},
                    {{ $stats['total_galleries'] }},
                    {{ $stats['total_partners'] }}
                ],
                backgroundColor: [
                    '#667eea',
                    '#f093fb',
                    '#4facfe',
                    '#fa709a'
                ],
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 20, usePointStyle: true }
                }
            }
        }
    });
</script>
@endsection
