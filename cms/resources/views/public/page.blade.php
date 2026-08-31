<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $page->title }} — GBASE Technologies</title>
    @if ($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/meanmenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nice-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/public-enhanced.css') }}" rel="stylesheet">
</head>
<body>
    @include('public.partials.mobile-nav')
    @include('public.partials.header')

    <main>
        @foreach ($page->sections as $section)
            <section class="gbase-section gbase-section--{{ $section->type }}">
                @switch ($section->type)
                    @case ('card_group')
                        <x-card-grid :section="$section" />
                        @break

                    @case ('image')
                        @if ($section->heading)<h2>{{ $section->heading }}</h2>@endif
                        @if ($section->image_path)
                            <img src="{{ asset('storage/' . $section->image_path) }}" alt="{{ $section->heading }}">
                        @endif
                        @break

                    @case ('rich_text')
                        @if ($section->heading)<h2>{{ $section->heading }}</h2>@endif
                        {!! $section->body !!}
                        @break

                    @default
                        @if ($section->heading)<h2>{{ $section->heading }}</h2>@endif
                        <div class="gbase-section__body">{!! nl2br(e($section->body)) !!}</div>
                @endswitch
            </section>
        @endforeach

        @foreach ($page->forms as $form)
            {!! $form->before_html !!}
            <x-dynamic-form :form="$form" :page-source="$page->slug" />
            {!! $form->after_html !!}
        @endforeach
    </main>

    @include('public.partials.footer')

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    @if ($page->custom_scripts)
        {!! $page->custom_scripts !!}
    @endif

    <script>
    // Same AJAX submit pattern as before: intercept, POST as FormData, show result.
    document.querySelectorAll('form.gbase-contact-form').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var btn = form.querySelector('.gbase-submit-btn');
            var originalText = btn ? btn.textContent : '';
            if (btn) { btn.textContent = 'Sending…'; btn.disabled = true; }

            fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'Accept': 'application/json' } })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    alert(data.message);
                    if (data.success) form.reset();
                    if (btn) { btn.textContent = originalText; btn.disabled = false; }
                })
                .catch(function () {
                    alert('Network error. Please check your connection and try again.');
                    if (btn) { btn.textContent = originalText; btn.disabled = false; }
                });
        });
    });
    </script>
</body>
</html>
