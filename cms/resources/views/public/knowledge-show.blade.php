@extends('public.knowledge-layout')
@section('title', $post->title)
@section('content')
    <a href="{{ route('knowledge.articles') }}">&larr; All articles</a>
    <div class="knowledge-article-heading">
        <p class="knowledge-eyebrow">Knowledge Centre</p>
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->excerpt }}</p>
        <p class="knowledge-count">{{ count($videos) }} {{ count($videos) === 1 ? 'video' : 'videos' }}</p>
    </div>
    <div class="knowledge-article-body">{!! nl2br(e($post->content)) !!}</div>
    @if(count($videos))
        <section class="knowledge-videos" data-article-videos aria-labelledby="article-videos-title">
            <h2 id="article-videos-title">Article videos</h2>
            <div class="knowledge-player" data-video-player>
                @if($videos[0]['type'] === 'embed')
                    <iframe src="{{ $videos[0]['src'] }}" title="{{ $videos[0]['title'] }}" allow="encrypted-media; picture-in-picture; fullscreen" allowfullscreen referrerpolicy="strict-origin-when-cross-origin"></iframe>
                @else
                    <video src="{{ $videos[0]['src'] }}" controls playsinline preload="metadata" aria-label="{{ $videos[0]['title'] }}"></video>
                @endif
            </div>
            <p class="knowledge-playing" data-now-playing aria-live="polite">Video 1 of {{ count($videos) }}</p>
            <ol class="knowledge-video-list">
                @foreach($videos as $index => $video)
                    <li>
                        <button type="button" data-select-video data-type="{{ $video['type'] }}" data-src="{{ $video['src'] }}" aria-pressed="{{ $index === 0 ? 'true' : 'false' }}">
                            <span class="knowledge-video-number">{{ $index + 1 }}</span>
                            <span><strong>{{ $video['title'] }}</strong><small>{{ parse_url($video['url'], PHP_URL_HOST) }}</small></span>
                        </button>
                        <noscript><a href="{{ $video['url'] }}" target="_blank" rel="noopener">Open {{ $video['title'] }}</a></noscript>
                    </li>
                @endforeach
            </ol>
        </section>
    @endif
@endsection
