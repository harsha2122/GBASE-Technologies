<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login — GBASE CMS</title>
    <style>
        body { font-family: system-ui, sans-serif; background: #f4f5f7; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
        .login-box { background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); width: 320px; }
        input { width: 100%; padding: 0.5rem; margin: 0.25rem 0 1rem; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; background: #1a2b3c; color: #fff; border: none; padding: 0.6rem; border-radius: 4px; cursor: pointer; }
        .errors { color: #b3261e; margin-bottom: 1rem; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>GBASE Admin</h2>
        @if ($errors->any())
            <div class="errors">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('admin.login.attempt') }}">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Log in</button>
        </form>
    </div>
</body>
</html>
