{{-- Generic card: used for equipment listings, process steps, service
     items, etc. — the layout auto-adjusts to however many cards a
     section has, no per-page markup needed. --}}
<div class="gbase-card">
    @if ($card->image_path)
        <img src="{{ asset('storage/' . $card->image_path) }}" alt="{{ $card->name }}" class="gbase-card__image">
    @endif
    <div class="gbase-card__body">
        <h3 class="gbase-card__title">{{ $card->name }}</h3>
        @if ($card->description)
            <p class="gbase-card__description">{{ $card->description }}</p>
        @endif
        @if ($card->link_url)
            <a href="{{ $card->link_url }}" class="gbase-card__link">Learn more &rarr;</a>
        @endif
    </div>
</div>
