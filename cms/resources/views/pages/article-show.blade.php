@extends('layouts.site')

@section('content')
  <div class="page-breadcrumb-area style-1">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="breadcrumb-wrapper">
            <div class="page-heading">
              <h3 class="page-title">{{ $article->title }}</h3>
            </div>
            <div class="breadcrumb-list">
              <ul>
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('articles.index') }}">Articles</a></li>
                <li class="active"><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="latest-posts-area style-1 py-40">
    <div class="container">
      <div class="row gy-5">
        <div class="col-lg-8">
          @if ($article->imageUrl())
          <div class="image mb-4">
            <img src="{{ $article->imageUrl() }}" alt="{{ $article->title }}" style="width:100%; border-radius: 10px;" />
          </div>
          @endif

          <div class="tag-wrapper mb-3">
            @foreach (($article->tags ?? []) as $tag)
            <span class="single-tag">{{ $tag }}</span>
            @endforeach
          </div>

          <div class="post-meta mb-4">
            <a class="single-post-meta"><span>{{ $article->author_name }}</span></a>
            <span class="dots"></span>
            <a class="single-post-meta"><span>{{ $article->published_at?->format('d/m/Y') }}</span></a>
          </div>

          <div class="article-body" style="line-height: 1.8; color: #444;">
            {!! $article->body !!}
          </div>

          <div class="mt-5">
            <a href="{{ route('articles.index') }}" class="theme-btn style-outline">
              <i class="fa-regular fa-arrow-left" style="margin-right: 6px;"></i> Back to Articles
            </a>
          </div>
        </div>

        <div class="col-lg-4">
          <h5 class="menu-sidebar-title mb-3">More Articles</h5>
          @foreach ($related as $item)
          <div class="post-card style-1 mb-3">
            <div class="content">
              <h3 class="title" style="font-size: 18px;">
                <a href="{{ route('articles.show', $item->slug) }}">{{ $item->title }}</a>
              </h3>
              <p class="desc">{{ $item->excerpt }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  @include('partials.brand-slider', ['content' => $brandSlider])
@endsection
