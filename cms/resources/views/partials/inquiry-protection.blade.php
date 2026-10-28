<div aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
    <label>Leave this field empty
        <input type="text" name="contact_fax" value="" tabindex="-1" autocomplete="off">
    </label>
</div>
@if($errors->any())
    <div role="alert" style="color:#991b1b;margin:12px 0;">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if(config('services.turnstile.enabled'))
    @if(config('services.turnstile.site_key'))
        <div data-inquiry-turnstile data-sitekey="{{ config('services.turnstile.site_key') }}" style="margin:16px 0;"></div>
        <noscript>Please enable JavaScript to verify and send your enquiry.</noscript>
    @else
        <p role="alert">Verification is temporarily unavailable. Please try again later.</p>
    @endif
@endif
