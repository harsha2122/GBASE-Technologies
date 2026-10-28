@extends('layouts.site')

@section('content')
  @php $listingHeader = $sections['listing_header']['content'] ?? []; @endphp
  <div class="page-breadcrumb-area style-1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="breadcrumb-wrapper">
            <div class="page-heading">
              <h3 class="page-title">{{ $listingHeader['heading'] ?? 'Videos' }}</h3>
            </div>
            <div class="breadcrumb-list">
              <ul>
                <li><a href="/">Home</a></li>
                <li class="active"><a href="/knowledge-videos.html">Videos</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Knowledge Videos Area Start -->
  <div class="latest-posts-area style-1 py-40">
    <div class="container">
      <div class="section-title">
        <div class="short-title-wrapper">
          <span class="short-title only-divider">{{ $listingHeader['short_title'] ?? 'Knowledge Centre' }}</span>
        </div>
        <div class="main-content">
          <div class="sec-content">
            <h2 class="title">{{ $listingHeader['heading'] ?? 'Videos' }}</h2>
          </div>
          <div class="sec-desc">
            <p class="desc">{{ $listingHeader['description'] ?? '' }}</p>
          </div>
        </div>
      </div>

      <div class="row gy-5">
        @forelse ($videos as $video)
        @php($videoUrls = $video->urls())
        <div class="col-xl-4 col-md-6">
          <div class="post-card style-1">
            <div class="image">
              <img src="{{ $video->thumbnailUrl() ?? '/images/project/IQF.png' }}" alt="{{ $video->title }}" />
              <div class="circle-btn-wrapper">
                @if (count($videoUrls))
                <button type="button" class="circle-btn" data-open-video-group="video-group-{{ $video->id }}" aria-label="Watch {{ $video->title }}">
                  <i class="fa-solid fa-play" aria-hidden="true"></i>
                </button>
                @else
                <span class="circle-btn">
                  <i class="fa-solid fa-play"></i>
                </span>
                @endif
              </div>
            </div>
            <div class="content">
              <div class="tag-wrapper">
                @foreach (($video->tags ?? []) as $tag)
                <span class="single-tag">{{ $tag }}</span>
                @endforeach
              </div>
              <h3 class="title">
                @if(count($videoUrls))
                  <button type="button" class="video-group-title" data-open-video-group="video-group-{{ $video->id }}">{{ $video->title }}</button>
                @else
                  {{ $video->title }}
                @endif
              </h3>
              <p class="desc">{{ $video->description }}</p>
              <p class="video-group-count">{{ count($videoUrls) }} {{ count($videoUrls) === 1 ? 'video' : 'videos' }}</p>
            </div>
          </div>
        </div>
        @if(count($videoUrls))
          @include('partials.video-group', ['video' => $video, 'videoUrls' => $videoUrls])
        @endif
        @empty
        <div class="col-12">
          <p class="desc text-center">No videos published yet.</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>
  <!-- Knowledge Videos Area End -->
<link rel="stylesheet" href="{{ asset('css/video-groups.css') }}?v=1">
<script src="{{ asset('js/video-groups.js') }}?v=1" defer></script>
@include('partials.brand-slider', ['content' => $brandSlider])
@endsection
