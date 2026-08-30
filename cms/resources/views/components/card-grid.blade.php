@if ($section->heading)
    <h2 class="gbase-section__heading">{{ $section->heading }}</h2>
@endif
<div class="gbase-card-grid">
    @foreach ($section->cards as $card)
        <x-card :card="$card" />
    @endforeach
</div>
