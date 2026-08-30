<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin') — GBASE CMS</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f4f5f7; color: #1a1a1a; }
        .admin-nav { background: #1a2b3c; color: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center; }
        .admin-nav a { color: #fff; text-decoration: none; margin-right: 1.5rem; }
        .admin-container { max-width: 1000px; margin: 2rem auto; padding: 0 1.5rem; }
        .card-box { background: #fff; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 0.6rem; border-bottom: 1px solid #eee; }
        input[type=text], input[type=email], input[type=password], input[type=number], textarea, select {
            width: 100%; padding: 0.5rem; margin: 0.25rem 0 1rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box;
        }
        label { font-weight: 600; font-size: 0.9rem; }
        button, .btn { background: #1a2b3c; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-danger { background: #b3261e; }
        .status { background: #e6f4ea; color: #1e7e34; padding: 0.75rem 1rem; border-radius: 4px; margin-bottom: 1rem; }
        .errors { background: #fdecea; color: #b3261e; padding: 0.75rem 1rem; border-radius: 4px; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <nav class="admin-nav">
        <div>
            <a href="{{ route('admin.pages.index') }}">Pages</a>
            <a href="{{ route('admin.forms.index') }}">Forms</a>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>

    <div class="admin-container">
        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="errors">
                <ul style="margin:0;padding-left:1.2rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
