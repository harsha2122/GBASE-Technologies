@extends('layouts.site')

@section('content')
@php
    $header = $sections['page_header']['content'] ?? [];
    $info = $sections['contact_info']['content'] ?? [];
    $about = $sections['company_about']['content'] ?? [];
@endphp
<div class="page-breadcrumb-area style-1">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<div class="page-heading">
<h3 class="page-title">{{ $header['heading'] ?? 'Contact' }}</h3>
</div>
<div class="breadcrumb-list">
<ul>
<li><a href="/">Home</a></li>
<li class="active"><a href="/contact.html">Contact</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="contact-form-area mt-3">
<div class="container">

<div class="row mb-5">
<div class="col-md-4 mb-4">
<div style="background:#f8f9fa; padding:30px; border-radius:10px; height:100%; border:1px solid #dee2e6; text-align:center;">
<img src="/images/icon/icon-1.png" alt="Phone" style="height:40px; margin-bottom:15px;" />
<h5 style="font-weight:700;">Contact number</h5>
@foreach (explode(',', $info['phone_numbers'] ?? '') as $number)
<p style="margin-bottom:4px;"><a href="tel:{{ trim($number) }}">{{ trim($number) }}</a></p>
@endforeach
</div>
</div>
<div class="col-md-4 mb-4">
<div style="background:#f8f9fa; padding:30px; border-radius:10px; height:100%; border:1px solid #dee2e6; text-align:center;">
<img src="/images/icon/icon-2.png" alt="Email" style="height:40px; margin-bottom:15px;" />
<h5 style="font-weight:700;">Contact Email</h5>
@foreach (explode(',', $info['emails'] ?? '') as $email)
<p style="margin-bottom:4px;"><a href="mailto:{{ trim($email) }}">{{ trim($email) }}</a></p>
@endforeach
</div>
</div>
<div class="col-md-4 mb-4">
<div style="background:#f8f9fa; padding:30px; border-radius:10px; height:100%; border:1px solid #dee2e6; text-align:center;">
<img src="/images/icon/icon-3.png" alt="Address" style="height:40px; margin-bottom:15px;" />
<h5 style="font-weight:700;">Address</h5>
<p>{{ $info['address'] ?? '' }}</p>
</div>
</div>
</div>

@include('partials.inquiry-form', ['pageSource' => 'contact.html'])

@if (! empty($about))
<div class="row mt-5">
<div class="col-lg-12">
<div style="background:#f8f9fa; padding:40px; border-radius:10px; border:1px solid #dee2e6;">
<h3 style="font-weight:700; margin-bottom:20px;">{{ $about['heading'] ?? 'About US' }}</h3>
<p style="color:#555; line-height:1.8;">{{ $about['description'] ?? '' }}</p>
@if (! empty($about['services']))
<h5 style="font-weight:700; margin-top:20px;">{{ $about['services_heading'] ?? 'Our Services' }}</h5>
<ul style="color:#555; line-height:1.8;">
@foreach ($about['services'] as $item)
<li>{{ $item }}</li>
@endforeach
</ul>
@endif
@if (! empty($about['principals']))
<h5 style="font-weight:700; margin-top:20px;">{{ $about['principals_heading'] ?? 'Our Principals' }}</h5>
<ul style="color:#555; line-height:1.8;">
@foreach ($about['principals'] as $item)
<li>{{ $item }}</li>
@endforeach
</ul>
@endif
</div>
</div>
</div>
@endif

</div>
</div>

@include('partials.brand-slider', ['content' => $brandSlider])
@endsection
