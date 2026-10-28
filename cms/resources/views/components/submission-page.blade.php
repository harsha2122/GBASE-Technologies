@props(['submission'])
@php($source = $submission->sourcePage())
<div>
    <strong>{{ $source['label'] }}</strong>
    @if($source['path'])
        <br><a href="{{ url($source['path']) }}" target="_blank" rel="noopener">{{ $source['path'] }}</a>
    @endif
    @if($source['inferred'])
        <br><small class="text-muted">From form's linked page; original source not recorded.</small>
    @endif
</div>
