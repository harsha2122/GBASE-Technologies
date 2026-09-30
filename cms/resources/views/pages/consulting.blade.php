@extends('layouts.site')

@section('content')
@php $header = $sections['page_header']['content'] ?? []; $dss = $sections['domain_scope_services']['content'] ?? []; @endphp
<div class="page-breadcrumb-area style-1">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<div class="page-heading">
<h3 class="page-title">{{ $header['heading'] ?? 'Consulting' }}</h3>
</div>
<div class="breadcrumb-list">
<ul>
<li><a href="/">Home</a></li>
<li class="active"><a href="/consulting.html">Consulting</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- Contact Form Area Start -->
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
        </div>
    </div>
</div>

<div class="gbase-contact-form-wrapper">
<div class="gbase-contact-header">
<i class="fa-light fa-temperature-snowflake"></i>
<h3>
            Your questions deserve the best answers.
            <span>Let's get in touch and talk about Individual Quick Freezing and
              Processing.</span>
</h3>
</div>
<form action="#" class="gbase-contact-form" method="post">
<div class="row"><input name="page_source" type="hidden" value="consulting.html"/>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="company" placeholder="Company *" required="" type="text"/>
</div>
</div>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="name" placeholder="Name *" required="" type="text"/>
</div>
</div>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="city" placeholder="City" type="text"/>
</div>
</div>
<div class="col-md-6">
<div class="gbase-form-group">
<select class="gbase-form-control country-select" name="country" required=""><option disabled="" selected="" value="">Country *</option><option value="Australia">Australia</option><option value="Bangladesh">Bangladesh</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="New Zealand">New Zealand</option><option value="Sri Lanka">Sri Lanka</option><option value="Others">Others</option></select>
<input class="gbase-form-control country-other-input" name="country_other" placeholder="Please specify country" style="display:none; margin-top:10px;" type="text"/>
</div>
</div>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="email" placeholder="Email *" required="" type="email"/>
</div>
</div>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="phone" placeholder="Phone *" required="" type="tel"/>
</div>
</div>
<div class="col-12">
<div class="gbase-form-group">
<input class="gbase-form-control" name="website" placeholder="Website" type="text"/>
</div>
</div>
<div class="col-12">
<div class="gbase-form-group">
<textarea class="gbase-form-control" name="message" placeholder="Type in your needs *" required="" rows="4"></textarea>
</div>
</div>
<div class="col-12">
<div class="gbase-form-group">
<div class="multi-wrap">
<button class="multi-btn" type="button">Select the type of product that you process * ▾</button>
<div class="multi-dropdown w-100">
<label><input name="product_types[]" type="checkbox" value="Seafood"/> Seafood</label>
<label><input name="product_types[]" type="checkbox" value="Meat"/> Meat</label>
<label><input name="product_types[]" type="checkbox" value="Poultry"/> Poultry</label>
<label><input name="product_types[]" type="checkbox" value="Vegetables"/> Vegetables</label>
<label><input name="product_types[]" type="checkbox" value="Fruit"/> Fruit</label>
<label><input name="product_types[]" type="checkbox" value="Ready Meals"/> Ready Meals</label>
<label><input name="product_types[]" type="checkbox" value="Bakery"/> Bakery</label>
<label><input name="product_types[]" type="checkbox" value="Dairy"/> Dairy</label>
<label><input name="product_types[]" type="checkbox" value="Ice Cream"/> Ice Cream</label>
</div>
</div>
<div class="selected-list" id="selected-list"></div>
</div>
</div>
<div class="row">
<!-- Pre-Process -->
<div class="col-lg-3 col-md-6 mb-3">
<div class="multi-wrap">
<button class="multi-btn" type="button">Pre-Process ▾</button>
<div class="multi-dropdown">
<label><input name="pre_process[]" type="checkbox" value="Cutting">
                      Cutting</input></label>
<label><input name="pre_process[]" type="checkbox" value="Dicing"> Dicing</input></label>
<label><input name="pre_process[]" type="checkbox" value="Slicing">
                      Slicing</input></label>
<label><input name="pre_process[]" type="checkbox" value="Washing">
                      Washing</input></label>
<label><input name="pre_process[]" type="checkbox" value="Blanching">
                      Blanching</input></label>
<label><input name="pre_process[]" type="checkbox" value="Chilling">
                      Chilling</input></label>
<label><input name="pre_process[]" type="checkbox" value="De-watering">
                      De-watering</input></label>
<label><input name="pre_process[]" type="checkbox" value="Peeling">
                      Peeling</input></label>
</div>
</div>
<div class="selected-list" id="preprocess-selected-list"></div>
</div>
<!-- Freezing -->
<div class="col-lg-3 col-md-6 mb-3">
<div class="multi-wrap">
<button class="multi-btn" type="button">Freezing ▾</button>
<div class="multi-dropdown">
<label><input name="freezing_equipment[]" type="checkbox" value="IQF"> IQF</input></label>
<label><input name="freezing_equipment[]" type="checkbox" value="Impingement Freezer"/>
                      Impingement Freezer</label>
<label><input name="freezing_equipment[]" type="checkbox" value="Spiral Freezer"/> Spiral
                      Freezer</label>
<label><input name="freezing_equipment[]" type="checkbox" value="Plate Freezer"/> Plate
                      Freezer</label>
<label><input name="freezing_equipment[]" type="checkbox" value="Carton Box Freezer"/>
                      Carton Box Freezer</label>
</div>
</div>
</div>
<!-- Heating -->
<div class="col-lg-3 col-md-6 mb-3">
<div class="multi-wrap">
<button class="multi-btn" type="button">Heating ▾</button>
<div class="multi-dropdown">
<label><input name="heating_equipment[]" type="checkbox" value="Contact Grills"/>
                      Contact Grills</label>
<label><input name="heating_equipment[]" type="checkbox" value="Oil Fryer"/> Oil
                      Fryer</label>
<label><input name="heating_equipment[]" type="checkbox" value="Baking Ovens"/> Baking
                      Ovens</label>
<label><input name="heating_equipment[]" type="checkbox" value="Oil Filtration"/> Oil
                      Filtration</label>
</div>
</div>
</div>
<!-- Sorting -->
<div class="col-lg-3 col-md-6 mb-3">
<div class="multi-wrap">
<button class="multi-btn" type="button">Round Fruit Sorting ▾</button>
<div class="multi-dropdown">
<label><input name="equipment_options[]" type="checkbox" value="Sorting Machines"/>
                      Sorting Machines</label>
<label><input name="equipment_options[]" type="checkbox" value="Conveyors"/>
                      Conveyors</label>
<label><input name="equipment_options[]" type="checkbox" value="Others"/> Others</label>
</div>
</div>
</div>
</div>
<div class="col-12">
<div class="gbase-form-group">
<select class="gbase-form-control" name="business_type" required="">
<option disabled="" selected="" value="">
                    Type of Business *
                  </option>
<option>Processor</option>
<option>Distributor</option>
<option>Retailer</option>
<option>Other</option>
</select>
</div>
</div>
<div class="col-12">
<div class="gbase-form-group">
<input class="gbase-form-control" name="production" placeholder="Estimated production in tons/hr *" required="" type="text"/>
</div>
</div>
<div class="col-12">
<div class="gbase-form-group">
<select class="gbase-form-control" name="referral">
<option disabled="" selected="" value="">
                    How did you find us?
                  </option>
<option>Search Engine</option>
<option>Social Media</option>
<option>Referral</option>
<option>Exhibition</option>
<option>Other</option>
</select>
</div>
</div>
<div class="col-12">
<button class="gbase-submit-btn" type="submit">
                SEND MESSAGE
              </button>
</div>
</div>
</form>
</div>
</div>
</div>
<!-- Contact Form Area End -->
@include('partials.brand-slider', ['content' => $brandSlider])
@endsection
