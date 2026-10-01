@extends('layouts.site')

@section('content')
@php $header = $sections['page_header']['content'] ?? []; @endphp
<div class="page-breadcrumb-area style-1">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<div class="page-heading">
<h3 class="page-title">{{ $header['heading'] ?? 'Get Equipments' }}</h3>
</div>
<div class="breadcrumb-list">
<ul>
<li><a href="/">Home</a></li>
<li class="active"><a href="/equipments.html">Equipments</a></li>
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
<div class="gbase-contact-form-wrapper">
<div class="gbase-contact-header">
<i class="fa-light fa-temperature-snowflake"></i>
<h3>
            {{ $header['cta_heading'] ?? '' }}
            <span>{{ $header['cta_subheading'] ?? '' }}</span>
</h3>
</div>
<form action="#" class="gbase-contact-form" method="post">
<div class="row"><input name="page_source" type="hidden" value="equipments.html"/>
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
<div class="gbase-form-group" style="border: 2px solid;">
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
<textarea class="gbase-form-control" name="message" onfocus="this.style.setProperty('--ph-color','#aaa'); this.style.setProperty('--ph-weight','300');" placeholder="Type in your needs *" required="" rows="4" style="border: 2px solid; font-weight: 400; color: #616161;"></textarea>
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
<div class="gbase-form-group" style="border: 2px solid;">
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
<div class="gbase-form-group" style="border: 2px solid;">
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
