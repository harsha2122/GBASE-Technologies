(function () {
  'use strict';

  var articles = window.GBASE_KNOWLEDGE_ARTICLES || [];

  function element(tag, className, text) {
    var node = document.createElement(tag);
    if (className) node.className = className;
    if (text !== undefined) node.textContent = text;
    return node;
  }

  function safeUrl(value) {
    if (typeof value !== 'string' || !value.trim()) return null;
    try {
      var url = new URL(value, window.location.href);
      if (url.protocol === 'https:' ||
          (url.protocol === 'http:' && url.origin === window.location.origin)) return url;
    } catch (error) { /* Invalid URLs are not published. */ }
    return null;
  }

  function videoSource(video) {
    var url = safeUrl(video.src);
    if (!url) return null;
    if (video.type === 'youtube') {
      var id;
      if (url.hostname === 'youtu.be') id = url.pathname.slice(1);
      if (['youtube.com', 'www.youtube.com', 'm.youtube.com', 'www.youtube-nocookie.com'].includes(url.hostname)) {
        id = url.searchParams.get('v');
        if (!id && /^\/(embed|shorts)\//.test(url.pathname)) id = url.pathname.split('/')[2];
      }
      if (!id || !/^[\w-]{11}$/.test(id)) return null;
      return 'https://www.youtube-nocookie.com/embed/' + id;
    }
    return video.type === 'file' ? url.href : null;
  }

  function publishedVideos(article) {
    return (article.videos || []).filter(function (video) {
      return video && typeof video.title === 'string' && video.title.trim() && videoSource(video);
    });
  }

  function countLabel(count) {
    return count + (count === 1 ? ' video' : ' videos');
  }

  document.querySelectorAll('[data-knowledge-article]').forEach(function (card) {
    var article = articles.find(function (item) { return item.id === card.dataset.knowledgeArticle; });
    if (!article) return;
    var link = card.querySelector('.title a');
    if (link) link.textContent = article.title;
    var description = card.querySelector('.desc');
    if (description) description.textContent = article.description;
    var image = card.querySelector('.image img');
    var thumbnail = safeUrl(article.thumbnail);
    if (image && thumbnail) { image.src = thumbnail.href; image.alt = article.title; }
    card.querySelector('.content').appendChild(element('p', 'knowledge-count', countLabel(publishedVideos(article).length)));
  });

  var articlePage = document.getElementById('knowledge-article');
  if (!articlePage) return;
  var id = new URLSearchParams(window.location.search).get('id');
  var article = articles.find(function (item) { return item.id === id; });
  var title = document.getElementById('article-title');
  var description = document.getElementById('article-description');
  var count = document.getElementById('article-video-count');
  var content = document.getElementById('article-video-content');
  if (!article) {
    document.title = 'GBASE | Article not found';
    title.textContent = 'Article not found';
    description.textContent = 'This article may have moved. Choose an article from the Knowledge Centre.';
    document.getElementById('article-videos-title').hidden = true;
    return;
  }

  document.title = 'GBASE | ' + article.title;
  title.textContent = article.title;
  description.textContent = article.description;
  (article.body || []).forEach(function (paragraph) {
    document.getElementById('article-body').appendChild(element('p', '', paragraph));
  });
  var videos = publishedVideos(article);
  count.textContent = countLabel(videos.length);
  if (!videos.length) {
    content.appendChild(element('p', 'knowledge-empty', 'Videos for this article will be available soon.'));
    return;
  }

  var player = element('div', 'knowledge-player');
  var nowPlaying = element('p', 'knowledge-now-playing');
  nowPlaying.setAttribute('aria-live', 'polite');
  var list = element('ol', 'knowledge-video-list');
  var buttons = [];
  content.append(player, nowPlaying, list);

  function selectVideo(index) {
    var video = videos[index];
    // Removing the previous player stops its playback, including embedded videos.
    var previous = player.querySelector('video');
    if (previous) { previous.pause(); previous.removeAttribute('src'); previous.load(); }
    player.replaceChildren();
    var media;
    if (video.type === 'youtube') {
      media = element('iframe');
      media.src = videoSource(video);
      media.title = video.title;
      media.allow = 'encrypted-media; picture-in-picture; fullscreen';
      media.allowFullscreen = true;
      media.referrerPolicy = 'strict-origin-when-cross-origin';
    } else {
      media = element('video');
      media.controls = true;
      media.preload = 'metadata';
      media.playsInline = true;
      media.setAttribute('aria-label', video.title);
      var poster = safeUrl(video.thumbnail || article.thumbnail);
      if (poster) media.poster = poster.href;
      media.src = videoSource(video);
      media.addEventListener('error', function () {
        nowPlaying.textContent = 'This video could not be loaded. Please try again later or choose another video.';
      });
      media.appendChild(element('p', '', 'Your browser does not support HTML video.'));
      (video.captions || []).forEach(function (caption) {
        var source = safeUrl(caption.src);
        if (!source) return;
        var track = element('track');
        track.kind = 'captions'; track.src = source.href;
        track.srclang = caption.language || 'en'; track.label = caption.label || 'English';
        media.appendChild(track);
      });
    }
    player.appendChild(media);
    nowPlaying.textContent = 'Video ' + (index + 1) + ' of ' + videos.length + ': ' + video.title;
    buttons.forEach(function (button, buttonIndex) {
      button.setAttribute('aria-pressed', String(buttonIndex === index));
    });
  }

  videos.forEach(function (video, index) {
    var item = element('li');
    var button = element('button', 'knowledge-video-button');
    button.type = 'button';
    button.setAttribute('aria-pressed', 'false');
    var thumbnail = safeUrl(video.thumbnail || article.thumbnail);
    if (thumbnail) {
      var image = element('img'); image.src = thumbnail.href; image.alt = ''; image.loading = 'lazy';
      button.appendChild(image);
    }
    var details = element('span', 'knowledge-video-details');
    details.appendChild(element('span', 'knowledge-video-title', (index + 1) + '. ' + video.title));
    if (video.duration) details.appendChild(element('span', 'knowledge-video-duration', video.duration));
    button.appendChild(details);
    button.addEventListener('click', function () { selectVideo(index); });
    buttons.push(button); item.appendChild(button); list.appendChild(item);
  });
  selectVideo(0);
}());
