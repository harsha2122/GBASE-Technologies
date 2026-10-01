@php
    $ctaHeading = $ctaHeading ?? ($header['cta_heading'] ?? '');
    $ctaSubheading = $ctaSubheading ?? ($header['cta_subheading'] ?? '');
@endphp
<div class="gbase-contact-form-wrapper">
<div class="gbase-contact-header">
<i class="fa-light fa-temperature-snowflake"></i>
<h3>
            {{ $ctaHeading }}
            <span>{{ $ctaSubheading }}</span>
</h3>
</div>
@if (session('inquiry_sent'))
<div class="alert alert-success" style="background:#e8f7ee; border:1px solid #16a34a; color:#15803d; padding:16px 20px; border-radius:8px; margin-bottom:20px;">
    Thank you — your message has been received. Our team will get back to you shortly.
</div>
@endif
<form action="{{ route('inquiries.store') }}" class="gbase-contact-form" method="post">
@csrf
<div class="row"><input name="page_source" type="hidden" value="{{ $pageSource }}"/>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="company" placeholder="Company *" required="" type="text" value="{{ old('company') }}"/>
</div>
</div>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="name" placeholder="Name *" required="" type="text" value="{{ old('name') }}"/>
</div>
</div>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="city" placeholder="City" type="text" value="{{ old('city') }}"/>
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
<input class="gbase-form-control" name="email" placeholder="Email *" required="" type="email" value="{{ old('email') }}"/>
</div>
</div>
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="phone" placeholder="Phone *" required="" type="tel" value="{{ old('phone') }}"/>
</div>
</div>
<div class="col-12">
<div class="gbase-form-group">
<input class="gbase-form-control" name="website" placeholder="Website" type="text" value="{{ old('website') }}"/>
</div>
</div>
<div class="col-12">
<div class="gbase-form-group">
<textarea class="gbase-form-control" name="message" placeholder="Type in your needs *" required="" rows="4">{{ old('message') }}</textarea>
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
<input class="gbase-form-control" name="production" placeholder="Estimated production in tons/hr *" required="" type="text" value="{{ old('production') }}"/>
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
