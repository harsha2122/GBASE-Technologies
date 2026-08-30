<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $page->title }} — GBASE Technologies</title>
    @if ($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
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

                    @default
                        @if ($section->heading)<h2>{{ $section->heading }}</h2>@endif
                        <div class="gbase-section__body">{!! nl2br(e($section->body)) !!}</div>
                @endswitch
            </section>
        @endforeach

        @foreach ($page->forms as $form)
            <section class="gbase-contact-form-wrapper">
                <x-dynamic-form :form="$form" :page-source="$page->slug" />
            </section>
        @endforeach
    </main>

    @include('public.partials.footer')

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
