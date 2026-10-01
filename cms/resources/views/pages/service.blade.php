@extends('layouts.site')

@section('content')
@php $header = $sections['page_header']['content'] ?? []; $dss = $sections['domain_scope_services']['content'] ?? []; @endphp
<div class="page-breadcrumb-area style-1">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<div class="page-heading">
<h3 class="page-title">{{ $header['heading'] ?? 'Service' }}</h3>
</div>
<div class="breadcrumb-list">
<ul>
<li><a href="/">Home</a></li>
<li class="active"><a href="/service.html">Service</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Contact Form Area Start -->
<div class="contact-form-area mt-3">
<div class="container">
<div class="row mb-5">
    <div class="col-lg-12">
        <div class="consulting-details-content">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div style="background: #f8f9fa; padding: 40px; border-radius: 10px; height: 100%; border: 1px solid #dee2e6;">
                        <h3 style="margin-bottom: 25px; font-weight: 700; color: #333;">{{ $dss['domain_heading'] ?? 'Domain' }}</h3>
                        <ul style="list-style-type: none; padding: 0; margin: 0; line-height: 1.8;">
                            @foreach (($dss['domain_items'] ?? []) as $item)
                            <li style="margin-bottom: 12px; color: #555;"><strong style="color: #222;">{{ $item['label'] ?? '' }}</strong> {{ $item['description'] ?? '' }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div style="background: #f8f9fa; padding: 40px; border-radius: 10px; height: 100%; border: 1px solid #dee2e6;">
                        <h3 style="margin-bottom: 25px; font-weight: 700; color: #333;">{{ $dss['scope_heading'] ?? 'Scope' }}</h3>
                        @foreach (($dss['scope_paragraphs'] ?? []) as $paragraph)
                        <p style="margin-bottom: 20px; color: #555; line-height: 1.8;">{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>
            </div>

            <div style="background: #f8f9fa; padding: 40px; border-radius: 10px; border: 1px solid #dee2e6;">
                <h3 style="margin-bottom: 30px; font-weight: 700; color: #333;">{{ $dss['services_heading'] ?? 'Services' }}</h3>
                <div class="row">
                    @foreach (($dss['services'] ?? []) as $service)
                    <div class="col-md-6 mb-4">
                        <div style="display: flex; align-items: flex-start;">
                            <i class="fa fa-check-circle" style="color: #0072ff; font-size: 24px; margin-top: 2px; margin-right: 15px;"></i>
                            <div>
                                <h6 style="font-weight: 700; margin-bottom: 8px; font-size: 16px;">{{ $service['title'] ?? '' }}</h6>
                                <p style="color: #555; font-size: 15px; margin-bottom: 0; line-height: 1.6;">{{ $service['description'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4 mb-4">
                    <a href="/service/equipment-audits.html" style="display:block; background:#f8f9fa; padding:30px; border-radius:10px; border:1px solid #dee2e6; text-align:center; text-decoration:none;">
                        <i class="fa fa-clipboard-check" style="font-size:28px; color:#0072ff; margin-bottom:12px;"></i>
                        <h6 style="font-weight:700; color:#222;">Equipment Audits</h6>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="/service/online-support.html" style="display:block; background:#f8f9fa; padding:30px; border-radius:10px; border:1px solid #dee2e6; text-align:center; text-decoration:none;">
                        <i class="fa fa-headset" style="font-size:28px; color:#0072ff; margin-bottom:12px;"></i>
                        <h6 style="font-weight:700; color:#222;">Online Support</h6>
                    </a>
                </div>
                <div class="col-md-4 mb-4">
                    <a href="/service/onsite-support.html" style="display:block; background:#f8f9fa; padding:30px; border-radius:10px; border:1px solid #dee2e6; text-align:center; text-decoration:none;">
                        <i class="fa fa-truck" style="font-size:28px; color:#0072ff; margin-bottom:12px;"></i>
                        <h6 style="font-weight:700; color:#222;">Onsite Support</h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.inquiry-form', ['pageSource' => 'service.html'])
</div>
</div>
<!-- Contact Form Area End -->
@include('partials.brand-slider', ['content' => $brandSlider])
@endsection
