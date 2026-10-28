(function () {
  'use strict';
  document.querySelectorAll('[data-article-videos]').forEach(function (gallery) {
    var player = gallery.querySelector('[data-video-player]');
    var status = gallery.querySelector('[data-now-playing]');
    var buttons = Array.from(gallery.querySelectorAll('[data-select-video]'));
    buttons.forEach(function (button, index) {
      button.addEventListener('click', function () {
        if (button.getAttribute('aria-pressed') === 'true') return;
        var previousVideo = player.querySelector('video');
        if (previousVideo) {
          previousVideo.pause();
          previousVideo.removeAttribute('src');
          previousVideo.load();
        }
        player.replaceChildren();
        var media;
        if (button.dataset.type === 'embed') {
          media = document.createElement('iframe');
          media.title = 'Video ' + (index + 1);
          media.allow = 'encrypted-media; picture-in-picture; fullscreen';
          media.allowFullscreen = true;
          media.referrerPolicy = 'strict-origin-when-cross-origin';
        } else {
          media = document.createElement('video');
          media.controls = true;
          media.playsInline = true;
          media.preload = 'metadata';
          media.setAttribute('aria-label', 'Video ' + (index + 1));
          media.addEventListener('error', function () {
            status.textContent = 'This video could not load. Please choose another video or try again later.';
          });
        }
        media.src = button.dataset.src;
        player.appendChild(media);
        buttons.forEach(function (item) { item.setAttribute('aria-pressed', String(item === button)); });
        status.textContent = 'Video ' + (index + 1) + ' of ' + buttons.length;
      });
    });
  });
}());
