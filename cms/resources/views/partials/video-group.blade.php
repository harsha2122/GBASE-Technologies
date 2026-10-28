<dialog id="video-group-{{ $video->id }}" class="video-group-dialog" aria-labelledby="video-group-title-{{ $video->id }}">
  <form method="dialog" class="video-group-close"><button type="submit" aria-label="Close videos">&times;</button></form>
  <h2 id="video-group-title-{{ $video->id }}">{{ $video->title }}</h2>
  <p>{{ $video->description }}</p>
  <div class="video-group-player" data-group-player></div>
  <p data-group-status aria-live="polite"></p>
  <ol class="video-group-list">
    @foreach($videoUrls as $index => $url)
      @php($source = \App\Support\VideoPlayer::source($url))
      <li>
        <button type="button" data-group-select data-type="{{ $source['type'] }}" data-src="{{ $source['src'] }}" aria-pressed="false">
          <img src="{{ $video->thumbnailUrl() ?? '/images/project/IQF.png' }}" alt="" loading="lazy">
          <span><strong>Video {{ $index + 1 }}</strong><small>{{ parse_url($url, PHP_URL_HOST) }}</small></span>
        </button>
        <a class="video-group-original" href="{{ $url }}" target="_blank" rel="noopener">Open video {{ $index + 1 }} in a new tab</a>
      </li>
    @endforeach
  </ol>
</dialog>
