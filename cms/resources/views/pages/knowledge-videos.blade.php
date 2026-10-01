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
        <div class="col-xl-4 col-md-6">
          <div class="post-card style-1">
            <div class="image">
              <img src="{{ $video->thumbnailUrl() ?? '/images/project/IQF.png' }}" alt="{{ $video->title }}" />
              <div class="circle-btn-wrapper">
                @if ($video->video_url)
                <a href="{{ $video->video_url }}" class="circle-btn" target="_blank" rel="noopener">
                  <i class="fa-solid fa-play"></i>
                </a>
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
              <h3 class="title">{{ $video->title }}</h3>
              <p class="desc">{{ $video->description }}</p>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12">
          <p class="desc text-center">No videos published yet.</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>
  <!-- Knowledge Videos Area End -->
@include('partials.brand-slider', ['content' => $brandSlider])
@endsection
