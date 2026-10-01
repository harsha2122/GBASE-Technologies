@extends('layouts.site')

@section('content')
@php $header = $sections['page_header']['content'] ?? []; @endphp
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
@include('partials.inquiry-form', ['pageSource' => $page->slug])
</div>
</div>

@include('partials.brand-slider', ['content' => $brandSlider])
@endsection
