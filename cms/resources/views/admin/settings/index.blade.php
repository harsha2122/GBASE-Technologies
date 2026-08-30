@extends('admin.layout')

@section('content')
<h2 class="mb-4">Site Settings & Customization</h2>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
    @csrf

    <!-- General Settings -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-cog"></i> General Settings</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="site_name" class="form-label">Site Name</label>
                <input type="text" name="site_name" id="site_name" class="form-control" value="{{ old('site_name', $settings->get('site_name')?->value ?? 'GBASE Technologies') }}" required>
            </div>

            <div class="mb-3">
                <label for="site_description" class="form-label">Site Description</label>
                <textarea name="site_description" id="site_description" class="form-control" rows="3">{{ old('site_description', $settings->get('site_description')?->value ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Media & Branding -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-image"></i> Media & Branding</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="site_logo" class="form-label">Site Logo</label>
                        @if($settings->get('site_logo')?->value)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings->get('site_logo')?->value) }}" alt="Logo" style="max-height: 80px; border-radius: 4px;">
                            </div>
                        @endif
                        <input type="file" name="site_logo" id="site_logo" class="form-control" accept="image/*">
                        <small class="text-muted">Max 2MB</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="site_favicon" class="form-label">Favicon</label>
                        @if($settings->get('site_favicon')?->value)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $settings->get('site_favicon')?->value) }}" alt="Favicon" style="max-height: 50px; border-radius: 4px;">
                            </div>
                        @endif
                        <input type="file" name="site_favicon" id="site_favicon" class="form-control" accept="image/*">
                        <small class="text-muted">Max 512KB. Usually 16x16 or 32x32 PNG</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-phone"></i> Contact Information</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="contact_email" class="form-label">Contact Email</label>
                <input type="email" name="contact_email" id="contact_email" class="form-control" value="{{ old('contact_email', $settings->get('contact_email')?->value ?? 'info@gbase.co.in') }}" required>
            </div>

            <div class="mb-3">
                <label for="contact_phone" class="form-label">Contact Phone</label>
                <input type="tel" name="contact_phone" id="contact_phone" class="form-control" value="{{ old('contact_phone', $settings->get('contact_phone')?->value ?? '') }}">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Office Address</label>
                <textarea name="address" id="address" class="form-control" rows="3">{{ old('address', $settings->get('address')?->value ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <!-- Social Media -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-share-alt"></i> Social Media Links</h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="facebook_url" class="form-label">Facebook</label>
                <input type="url" name="facebook_url" id="facebook_url" class="form-control" value="{{ old('facebook_url', $settings->get('facebook_url')?->value ?? '') }}" placeholder="https://facebook.com/...">
            </div>

            <div class="mb-3">
                <label for="twitter_url" class="form-label">Twitter / X</label>
                <input type="url" name="twitter_url" id="twitter_url" class="form-control" value="{{ old('twitter_url', $settings->get('twitter_url')?->value ?? '') }}" placeholder="https://twitter.com/...">
            </div>

            <div class="mb-3">
                <label for="linkedin_url" class="form-label">LinkedIn</label>
                <input type="url" name="linkedin_url" id="linkedin_url" class="form-control" value="{{ old('linkedin_url', $settings->get('linkedin_url')?->value ?? '') }}" placeholder="https://linkedin.com/...">
            </div>

            <div class="mb-3">
                <label for="instagram_url" class="form-label">Instagram</label>
                <input type="url" name="instagram_url" id="instagram_url" class="form-control" value="{{ old('instagram_url', $settings->get('instagram_url')?->value ?? '') }}" placeholder="https://instagram.com/...">
            </div>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            <i class="fas fa-save"></i> Save Settings
        </button>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-lg">Back</a>
    </div>
</form>
@endsection
