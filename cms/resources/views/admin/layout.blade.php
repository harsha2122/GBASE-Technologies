<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') — GBASE CMS</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1a2b3c;
            --primary-blue: #0066cc;
            --accent-orange: #ff6b35;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
        }

        body {
            background-color: var(--light-bg);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #2a3f54 100%);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 0.75rem 1.5rem;
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
            color: #fff !important;
        }

        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.8) !important;
            transition: color 0.3s ease;
            margin: 0 0.5rem;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #fff !important;
        }

        /* Sidebar */
        .sidebar {
            background: #fff;
            border-right: 1px solid var(--border-color);
            min-height: calc(100vh - 60px);
            padding: 1.5rem 0;
        }

        .sidebar .nav-link {
            color: #495057;
            padding: 0.75rem 1.5rem;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background-color: #f0f0f0;
            color: var(--primary-blue);
        }

        .sidebar .nav-link.active {
            background-color: #e8f1ff;
            border-left-color: var(--primary-blue);
            color: var(--primary-blue);
            font-weight: 600;
        }

        .sidebar .nav-section {
            padding: 0.5rem 0;
            margin-top: 1rem;
        }

        .sidebar .nav-section-title {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #999;
            padding: 0.5rem 1.5rem;
            letter-spacing: 0.5px;
        }

        /* Main Content */
        .main-content {
            padding: 2rem;
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
        }

        /* Tables */
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid var(--border-color);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            color: #495057;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Buttons */
        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
        }

        .btn-primary:hover {
            background-color: #0052a3;
            border-color: #0052a3;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
        }

        /* Alerts */
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        /* Forms */
        .form-control, .form-select {
            border: 1px solid var(--border-color);
            border-radius: 4px;
            padding: 0.5rem 0.75rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.25);
        }

        /* Badges */
        .badge {
            padding: 0.4rem 0.7rem;
            font-size: 0.85rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-cog"></i> GBASE CMS
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Welcome, Admin</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 sidebar">
                <ul class="nav flex-column">
                    <div class="nav-section">
                        <div class="nav-section-title">Core</div>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}"
                               href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-chart-line"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'pages') ? 'active' : '' }}"
                               href="{{ route('admin.pages.index') }}">
                                <i class="fas fa-file-alt"></i> Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'forms') ? 'active' : '' }}"
                               href="{{ route('admin.forms.index') }}">
                                <i class="fas fa-wpforms"></i> Forms
                            </a>
                        </li>
                    </div>

                    <div class="nav-section">
                        <div class="nav-section-title">Content</div>
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'gallery') ? 'active' : '' }}"
                               href="{{ route('admin.gallery.index') }}">
                                <i class="fas fa-images"></i> Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'blog') ? 'active' : '' }}"
                               href="{{ route('admin.blog.index') }}">
                                <i class="fas fa-blog"></i> Blog & Articles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'partners') ? 'active' : '' }}"
                               href="{{ route('admin.partners.index') }}">
                                <i class="fas fa-handshake"></i> Partners
                            </a>
                        </li>
                    </div>

                    <div class="nav-section">
                        <div class="nav-section-title">Settings</div>
                        <li class="nav-item">
                            <a class="nav-link {{ str_contains(Route::currentRouteName(), 'settings') ? 'active' : '' }}"
                               href="{{ route('admin.settings.index') }}">
                                <i class="fas fa-sliders-h"></i> Site Settings
                            </a>
                        </li>
                    </div>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 main-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
