<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — GBASE Technologies</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/public-enhanced.css') }}" rel="stylesheet">
    <link href="{{ asset('css/article-videos.css') }}?v=1" rel="stylesheet">
</head>
<body class="knowledge-cms">
    @include('public.partials.mobile-nav')
    @include('public.partials.header')
    <main class="knowledge-content">
        @yield('content')
    </main>
    @include('public.partials.footer')
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/article-videos.js') }}?v=1" defer></script>
</body>
</html>
