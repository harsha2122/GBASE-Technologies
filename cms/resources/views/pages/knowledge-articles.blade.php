@extends('layouts.site')

@section('content')
  @php $listingHeader = $sections['listing_header']['content'] ?? []; @endphp
  <div class="page-breadcrumb-area style-1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="breadcrumb-wrapper">
            <div class="page-heading">
              <h3 class="page-title">{{ $listingHeader['heading'] ?? 'Articles' }}</h3>
            </div>
            <div class="breadcrumb-list">
              <ul>
                <li><a href="/">Home</a></li>
                <li class="active"><a href="/knowledge-articles.html">Articles</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Knowledge Articles Area Start -->
  <div class="latest-posts-area style-1 py-40">
    <div class="container">
      <div class="section-title">
        <div class="short-title-wrapper">
          <span class="short-title only-divider">{{ $listingHeader['short_title'] ?? 'Knowledge Centre' }}</span>
        </div>
        <div class="main-content">
          <div class="sec-content">
            <h2 class="title">{{ $listingHeader['heading'] ?? 'Articles' }}</h2>
          </div>
          <div class="sec-desc">
            <p class="desc">{{ $listingHeader['description'] ?? '' }}</p>
          </div>
        </div>
      </div>

      <div class="row gy-5">
        @forelse ($articles as $article)
        <div class="col-xl-4 col-md-6">
          <div class="post-card style-1">
            <div class="image">
              <img src="{{ $article->imageUrl() ?? '/images/project/IQF.png' }}" alt="{{ $article->title }}" />
              <div class="circle-btn-wrapper">
                <a href="{{ route('articles.show', $article->slug) }}" class="circle-btn">
                  <i class="fa-regular fa-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="content">
              <div class="tag-wrapper">
                @foreach (($article->tags ?? []) as $tag)
                <span class="single-tag">{{ $tag }}</span>
                @endforeach
              </div>
              <h3 class="title">
                <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
              </h3>
              <p class="desc">{{ $article->excerpt }}</p>
              <div class="post-meta">
                <a class="single-post-meta"><span>{{ $article->author_name }}</span></a>
                <span class="dots"></span>
                <a class="single-post-meta"><span>{{ $article->published_at?->format('d/m/Y') }}</span></a>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12">
          <p class="desc text-center">No articles published yet.</p>
        </div>
        @endforelse
      </div>

      <div class="mt-5">
        {{ $articles->links() }}
      </div>
    </div>
  </div>
  <!-- Knowledge Articles Area End -->
@include('partials.brand-slider', ['content' => $brandSlider])
@endsection
