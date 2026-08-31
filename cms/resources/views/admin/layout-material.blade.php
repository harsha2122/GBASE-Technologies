<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') — GBASE CMS</title>

    <!-- Material-UI & Material Icons CDN -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/4.0.0/material-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1976d2;
            --primary-dark: #1565c0;
            --primary-light: #42a5f5;
            --secondary: #dc004e;
            --background: #fafafa;
            --paper: #ffffff;
            --text-primary: rgba(0, 0, 0, 0.87);
            --text-secondary: rgba(0, 0, 0, 0.6);
            --divider: rgba(0, 0, 0, 0.12);
            --success: #4caf50;
            --warning: #ff9800;
            --error: #f44336;
            --info: #2196f3;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background);
            color: var(--text-primary);
            margin: 0;
            padding: 0;
        }

        /* Header/Navbar */
        .header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        /* Main Layout */
        .layout {
            display: flex;
            min-height: calc(100vh - 64px);
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--paper);
            border-right: 1px solid var(--divider);
            overflow-y: auto;
            padding: 1rem 0;
        }

        .sidebar-section {
            margin-bottom: 2rem;
        }

        .sidebar-section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-secondary);
            padding: 0.5rem 1.5rem;
            letter-spacing: 0.5px;
        }

        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1.5rem;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .sidebar-item:hover {
            background-color: rgba(0,0,0,0.04);
            color: var(--primary);
        }

        .sidebar-item.active {
            background-color: rgba(25, 118, 210, 0.08);
            color: var(--primary);
            border-left-color: var(--primary);
            font-weight: 500;
        }

        .sidebar-item i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        /* Cards */
        .card {
            background: var(--paper);
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
            overflow: hidden;
            margin-bottom: 1.5rem;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
            transform: translateY(-2px);
        }

        .card-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--divider);
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--paper);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            border-left: 4px solid var(--primary);
        }

        .stat-card.success { border-left-color: var(--success); }
        .stat-card.warning { border-left-color: var(--warning); }
        .stat-card.error { border-left-color: var(--error); }
        .stat-card.info { border-left-color: var(--info); }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-change {
            font-size: 0.8rem;
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--error);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 4px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            font-family: 'Roboto', sans-serif;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            box-shadow: 0 4px 8px rgba(25, 118, 210, 0.3);
        }

        .btn-secondary {
            background-color: #f5f5f5;
            color: var(--text-primary);
            border: 1px solid var(--divider);
        }

        .btn-secondary:hover {
            background-color: #eeeeee;
        }

        .btn-danger {
            background-color: var(--error);
            color: white;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }

        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
        }

        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead th {
            background-color: #f5f5f5;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-secondary);
            border-bottom: 2px solid var(--divider);
            text-transform: uppercase;
        }

        .table tbody td {
            padding: 1rem;
            border-bottom: 1px solid var(--divider);
            color: var(--text-primary);
        }

        .table tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.8rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge.success { background-color: rgba(76, 175, 80, 0.1); color: var(--success); }
        .badge.warning { background-color: rgba(255, 152, 0, 0.1); color: var(--warning); }
        .badge.error { background-color: rgba(244, 67, 54, 0.1); color: var(--error); }
        .badge.info { background-color: rgba(33, 150, 243, 0.1); color: var(--info); }

        /* Forms */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--divider);
            border-radius: 4px;
            font-family: 'Roboto', sans-serif;
            font-size: 0.95rem;
            color: var(--text-primary);
            transition: border-color 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(25, 118, 210, 0.1);
        }

        /* Alerts */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert.success {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        .alert.error {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--error);
            border-left: 4px solid var(--error);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: absolute;
                width: 100%;
                left: -280px;
                height: calc(100vh - 64px);
                z-index: 50;
                transition: left 0.3s ease;
            }

            .sidebar.open {
                left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-title">
            <i class="fas fa-chart-line"></i>
            GBASE CMS
        </div>
        <div class="header-actions">
            <span>Welcome, Admin</span>
            <form method="POST" action="{{ route('admin.logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="btn btn-secondary" style="background: rgba(255,255,255,0.2); border: none; color: white;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Layout -->
    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-section">
                <div class="sidebar-section-title">Dashboard</div>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-item {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Overview</span>
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Content Management</div>
                <a href="{{ route('admin.pages.index') }}" class="sidebar-item {{ str_contains(Route::currentRouteName(), 'pages') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Pages</span>
                </a>
                <a href="{{ route('admin.gallery.index') }}" class="sidebar-item {{ str_contains(Route::currentRouteName(), 'gallery') ? 'active' : '' }}">
                    <i class="fas fa-images"></i>
                    <span>Gallery</span>
                </a>
                <a href="{{ route('admin.blog.index') }}" class="sidebar-item {{ str_contains(Route::currentRouteName(), 'blog') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Blog</span>
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Forms & Submissions</div>
                <a href="{{ route('admin.forms.index') }}" class="sidebar-item {{ str_contains(Route::currentRouteName(), 'forms') ? 'active' : '' }}">
                    <i class="fas fa-wpforms"></i>
                    <span>Forms</span>
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">Organization</div>
                <a href="{{ route('admin.partners.index') }}" class="sidebar-item {{ str_contains(Route::currentRouteName(), 'partners') ? 'active' : '' }}">
                    <i class="fas fa-handshake"></i>
                    <span>Partners</span>
                </a>
            </div>

            <div class="sidebar-section">
                <div class="sidebar-section-title">System</div>
                <a href="{{ route('admin.settings.index') }}" class="sidebar-item {{ str_contains(Route::currentRouteName(), 'settings') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @if (session('success'))
                <div class="alert success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="alert error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert error">
                    <div>
                        <i class="fas fa-exclamation-circle"></i>
                        <ul style="margin-top: 0.5rem; padding-left: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
