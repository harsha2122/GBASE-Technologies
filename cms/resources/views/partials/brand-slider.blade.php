@php $brand = $content ?? []; @endphp
<div class="brand-slider-area style-1">
  <div class="container">
    <h2 style="margin-bottom: 20px; text-align: center;">{{ $brand['heading'] ?? '' }}</h2>
    <div class="client-logo-wrapper">
      @foreach (($brand['logos'] ?? []) as $logo)
      <div class="client-logo-item">
        <div class="client-logo">
          <div class="client-logo-box">
            <img alt="Client Logo" src="{{ \App\Models\PageSection::resolveImage($logo['image'] ?? null) }}" />
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
