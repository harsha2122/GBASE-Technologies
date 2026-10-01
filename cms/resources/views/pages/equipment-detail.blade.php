@extends('layouts.site')

@section('content')
@php
    $header = $sections['page_header']['content'] ?? [];
    $cards = $sections['equipment_cards']['content'] ?? [];
@endphp
<div class="page-breadcrumb-area style-1">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<div class="page-heading">
<h3 class="page-title">{{ $header['heading'] ?? $page->title }}</h3>
</div>
<div class="breadcrumb-list">
<ul>
<li><a href="/">Home</a></li>
<li class="active"><a href="{{ $page->publicUrl() }}">{{ $header['heading'] ?? $page->title }}</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="contact-form-area mt-3">
<div class="container">

@if (! empty($cards['intro_short_title']) || ! empty($cards['intro_heading']) || ! empty($cards['intro_description']))
<div class="section-title text-center mb-4">
@if (! empty($cards['intro_short_title']))
<div class="short-title-wrapper">
<span class="short-title only-divider">{{ $cards['intro_short_title'] }}</span>
</div>
@endif
@if (! empty($cards['intro_heading']))
<div class="main-content">
<div class="sec-content">
<h2 class="title">{{ $cards['intro_heading'] }}</h2>
</div>
@if (! empty($cards['intro_description']))
<div class="sec-desc">
<p class="desc">{{ $cards['intro_description'] }}</p>
</div>
@endif
</div>
@endif
</div>
@endif

@if (! empty($cards['cards']))
<div class="row mb-5">
@foreach ($cards['cards'] as $card)
<div class="col-md-6 mb-4">
<div style="background: #f8f9fa; padding: 30px; border-radius: 10px; height: 100%; border: 1px solid #dee2e6;">
@php $cardImage = \App\Models\PageSection::resolveImage($card['image'] ?? null); @endphp
@if ($cardImage)
<img src="{{ $cardImage }}" alt="{{ $card['heading'] ?? '' }}" style="max-width:100%; height:auto; border-radius:6px; margin-bottom:20px;" />
@endif
<h3 style="font-weight: 700; color: #333; margin-bottom: 10px;">
    {{ $card['heading'] ?? '' }}
    @if (! empty($card['sub_label']))
    <span style="display:block; font-size: 14px; font-weight: 400; color: #777;">{{ $card['sub_label'] }}</span>
    @endif
</h3>
@if (! empty($card['description']))
<p style="color: #555; line-height: 1.7; white-space: pre-line;">{{ $card['description'] }}</p>
@endif
@if (! empty($card['bullets']))
<ul style="padding-left: 18px; color: #555; line-height: 1.8;">
@foreach ($card['bullets'] as $bullet)
<li>{{ $bullet }}</li>
@endforeach
</ul>
@endif
@if (! empty($card['product_group']))
<div style="display:flex; flex-wrap:wrap; gap:16px; margin-top:16px;">
@foreach ($card['product_group'] as $item)
@php $iconUrl = \App\Models\PageSection::resolveImage($item['icon'] ?? null); @endphp
<div style="text-align:center; width:70px;">
@if ($iconUrl)
<img src="{{ $iconUrl }}" alt="{{ $item['label'] ?? '' }}" title="{{ $item['label'] ?? '' }}" style="width:40px; height:40px; object-fit:contain;" />
@endif
<div style="font-size:11px; color:#777; margin-top:4px;">{{ $item['label'] ?? '' }}</div>
</div>
@endforeach
</div>
@endif
@if (! empty($card['link']))
<a href="{{ $card['link'] }}" class="theme-btn mt-3" style="display:inline-block; margin-top:16px;">Learn More</a>
@endif
</div>
</div>
@endforeach
</div>
@endif

@include('partials.inquiry-form', [
    'pageSource' => $page->slug,
    'ctaHeading' => $header['cta_heading'] ?? '',
    'ctaSubheading' => $header['cta_subheading'] ?? '',
])

</div>
</div>

@include('partials.brand-slider', ['content' => $brandSlider])
@endsection
