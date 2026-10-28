(function () {
  'use strict';
  document.querySelectorAll('.video-group-dialog').forEach(function (dialog) {
    var player = dialog.querySelector('[data-group-player]');
    var status = dialog.querySelector('[data-group-status]');
    var buttons = Array.from(dialog.querySelectorAll('[data-group-select]'));
    var opener;
    function stop() {
      var video = player.querySelector('video');
      if (video) { video.pause(); video.removeAttribute('src'); video.load(); }
      player.replaceChildren();
    }
    function select(index) {
      stop();
      var button = buttons[index];
      var media;
      if (button.dataset.type === 'embed') {
        media = document.createElement('iframe');
        media.title = 'Video ' + (index + 1);
        media.allow = 'encrypted-media; picture-in-picture; fullscreen';
        media.allowFullscreen = true;
        media.referrerPolicy = 'strict-origin-when-cross-origin';
        media.src = button.dataset.src;
      } else if (button.dataset.type === 'file') {
        media = document.createElement('video');
        media.controls = true;
        media.playsInline = true;
        media.preload = 'metadata';
        media.setAttribute('aria-label', 'Video ' + (index + 1));
        media.src = button.dataset.src;
        media.addEventListener('error', function () { status.textContent = 'This video could not load. Try its original link below or choose another video.'; });
      } else {
        media = document.createElement('a');
        media.href = button.dataset.src;
        media.target = '_blank';
        media.rel = 'noopener';
        media.textContent = 'Open video in a new tab';
      }
      player.appendChild(media);
      status.textContent = 'Video ' + (index + 1) + ' of ' + buttons.length;
      buttons.forEach(function (item) { item.setAttribute('aria-pressed', String(item === button)); });
    }
    buttons.forEach(function (button, index) { button.addEventListener('click', function () { select(index); }); });
    document.querySelectorAll('[data-open-video-group]').forEach(function (button) {
      if (button.dataset.openVideoGroup !== dialog.id) return;
      button.addEventListener('click', function () {
        opener = button;
        select(0);
        dialog.showModal();
      });
    });
    dialog.addEventListener('close', function () { stop(); if (opener) opener.focus(); });
    dialog.addEventListener('click', function (event) {
      if (event.target !== dialog) return;
      var bounds = dialog.getBoundingClientRect();
      if (event.clientX < bounds.left || event.clientX > bounds.right || event.clientY < bounds.top || event.clientY > bounds.bottom) dialog.close();
    });
  });
}());
