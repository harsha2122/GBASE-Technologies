@extends('layouts.site')

@section('content')
@php $header = $sections['page_header']['content'] ?? []; @endphp
<div class="page-breadcrumb-area style-1">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="breadcrumb-wrapper">
<div class="page-heading">
<h3 class="page-title">{{ $header['heading'] ?? 'Spare Parts' }}</h3>
</div>
<div class="breadcrumb-list">
<ul>
<li><a href="/">Home</a></li>
<li class="active"><a href="/spare_parts.html">Spare Parts</a></li>
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
<div class="gbase-contact-form-wrapper">
<div class="gbase-contact-header">
<i class="fa-light fa-temperature-snowflake"></i>
<h3>
            Your questions deserve the best answers.
            <span>Let's get in touch and talk.</span>
</h3>
</div>
<form action="#" class="gbase-contact-form" method="post" enctype="multipart/form-data">
<div class="row"><input name="page_source" type="hidden" value="spare_parts.html"/>
<!-- Company -->
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="company" required="" type="text"/>
<label>Company <span style="color:red">*</span></label>
</div>
</div>
<!-- Name -->
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="name" required="" type="text"/>
<label>Name <span style="color:red">*</span></label>
</div>
</div>
<!-- Email -->
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="email" required="" type="email"/>
<label>Email <span style="color:red">*</span></label>
</div>
</div>
<!-- Phone -->
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="phone" required="" type="tel"/>
<label>Phone <span style="color:red">*</span></label>
</div>
</div>
<!-- Website -->
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="website" type="text"/>
<label>Website</label>
</div>
</div>
<!-- Machine Serial No. -->
<div class="col-md-6">
<div class="gbase-form-group">
<input class="gbase-form-control" name="machine_serial_no" type="text"/>
<label>Machine Serial No.</label>
</div>
</div>
<!-- Pre-Process -->
<div class="row">
<div class="col-12 mb-2">
<label><strong>Machine Name * (Select from categories or choose 'Others' to specify)</strong></label>
</div>
<!-- Pre-Process -->
<div class="col-lg-3 col-md-6 mb-3">
<div class="multi-wrap">
<button class="multi-btn" type="button">Pre-Process ▾</button>
<div class="multi-dropdown">
<label><input name="pre_process[]" type="checkbox" value="Cutting"/> Cutting</label>
<label><input name="pre_process[]" type="checkbox" value="Dicing"/> Dicing</label>
<label><input name="pre_process[]" type="checkbox" value="Slicing"/> Slicing</label>
<label><input name="pre_process[]" type="checkbox" value="Washing"/> Washing</label>
<label><input name="pre_process[]" type="checkbox" value="Blanching"/> Blanching</label>
<label><input name="pre_process[]" type="checkbox" value="Chilling"/> Chilling</label>
<label><input name="pre_process[]" type="checkbox" value="De-watering"/> De-watering</label>
<label><input name="pre_process[]" type="checkbox" value="Peeling"/> Peeling</label>
</div>
</div>
<div class="selected-list" id="preprocess-selected-list"></div>
</div>
<!-- Freezing -->
<div class="col-lg-3 col-md-6 mb-3">
<div class="multi-wrap">
<button class="multi-btn" type="button">Freezing ▾</button>
<div class="multi-dropdown">
<label><input name="freezing_equipment[]" type="checkbox" value="IQF"/> IQF</label>
<label><input name="freezing_equipment[]" type="checkbox" value="Impingement Freezer"/> Impingement Freezer</label>
<label><input name="freezing_equipment[]" type="checkbox" value="Spiral Freezer"/> Spiral Freezer</label>
<label><input name="freezing_equipment[]" type="checkbox" value="Plate Freezer"/> Plate Freezer</label>
<label><input name="freezing_equipment[]" type="checkbox" value="Carton Box Freezer"/> Carton Box Freezer</label>
</div>
</div>
</div>
<!-- Heating -->
<div class="col-lg-3 col-md-6 mb-3">
<div class="multi-wrap">
<button class="multi-btn" type="button">Heating ▾</button>
<div class="multi-dropdown">
<label><input name="heating_equipment[]" type="checkbox" value="Contact Grills"/> Contact Grills</label>
<label><input name="heating_equipment[]" type="checkbox" value="Oil Fryer"/> Oil Fryer</label>
<label><input name="heating_equipment[]" type="checkbox" value="Spiral Ovens"/> Spiral Ovens</label>
<label><input name="heating_equipment[]" type="checkbox" value="Linear Ovens"/> Linear Ovens</label>
<label><input name="heating_equipment[]" type="checkbox" value="Oil Filtration"/> Oil Filtration</label>
</div>
</div>
</div>
<!-- Sorting -->
<div class="col-lg-3 col-md-6 mb-3">
<div class="multi-wrap">
<button class="multi-btn" type="button">Round Fruit Sorting ▾</button>
<div class="multi-dropdown">
<label><input name="equipment_options[]" type="checkbox" value="Sorting Machines"/> Sorting Machines</label>
<label><input name="equipment_options[]" type="checkbox" value="Conveyors"/> Conveyors</label>
<label><input name="equipment_options[]" type="checkbox" value="Others"/> Others</label>
</div>
</div>
</div>
</div>
<!-- Selected Equipment -->
<div class="col-12">
<div class="selected-list mb-3" id="selected-equipment"></div>
</div>
<div class="col-12" id="others-input" style="display:none;">
<div class="gbase-form-group">
<input class="gbase-form-control" name="others_specify" type="text">
<label>Others (Specify)</label>
</input></div>
</div>
<div class="col-12">
<div class="mb-3">
<label style="display:block; margin-bottom:8px;"><strong>Part Details</strong></label>
<div class="table-responsive">
<table class="table table-bordered align-middle">
<thead>
<tr>
<th>Part Serial No. <span style="color:red">*</span></th>
<th>Part Picture</th>
<th>Quantity Required <span style="color:red">*</span></th>
<th style="width: 90px;">Action</th>
</tr>
</thead>
<tbody id="part-lines">
<tr>
<td>
<input class="gbase-form-control" name="part_serial_no[]" required="" type="text">
</input></td>
<td>
<input accept="image/*" class="gbase-form-control" multiple="" name="part_picture_1[]" type="file">
</input></td>
<td>
<input class="gbase-form-control" min="1" name="quantity_required[]" required="" type="number">
</input></td>
<td class="text-center">
<button class="btn btn-sm btn-outline-danger remove-part-row" title="Remove row" type="button">Remove</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<button class="gbase-submit-btn mb-2" id="add-part-row" type="button">+ Add Part Row</button>
</div>
<!-- Submit -->
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
