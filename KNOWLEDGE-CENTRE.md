# Publishing multiple videos in one article

Both Knowledge Centre listings open `knowledge-article.html?id=ARTICLE_ID`.
The article uses one main player with a selectable list below it. The first
video is selected initially; playback starts when the visitor presses Play.
The list stacks into one column on mobile. Video counts update automatically.

Edit `js/knowledge-data.js`. Each article has its own `videos` array; add one
object per video. There is no one-video limit. The current arrays are empty
because the repository did not contain video files or playback URLs.

For example, replace an article's `videos: []` with the following, using your
actual uploaded file paths and YouTube link (these values are placeholders):

```js
videos: [
  {
    title: 'Line overview',
    type: 'file',
    src: '/videos/line-overview.mp4',
    thumbnail: '/images/project/IQF.png',
    duration: '02:35',
    captions: [
      { src: '/videos/line-overview.en.vtt', language: 'en', label: 'English' }
    ]
  },
  {
    title: 'Daily checks',
    type: 'youtube',
    src: 'https://www.youtube.com/watch?v=YOUR_VIDEO_ID',
    duration: '04:10'
  }
]
```

`title`, `type` and `src` are required. `thumbnail`, `duration` and `captions`
are optional. Without a video thumbnail, the article thumbnail is used.
Use browser-compatible MP4 (H.264/AAC), WebM, or an embeddable YouTube video.
YouTube watch, short, share and embed URLs are supported. Private videos or
videos whose owners disable embedding cannot play on the site. Invalid sources
are excluded from both the list and count. Article text is plain text: put
each paragraph in the article's `body` array.

Upload local videos to the matching location on your web server, such as
`/var/www/backup-edudag-1/current/videos/line-overview.mp4`. Large video uploads
should be stored on hosting/CDN storage rather than committed to Git. Ensure
your deployment preserves uploaded files across releases. Commit/push the
updated data file so the server can pull it. If you change assets after this
release, increment their `?v=` cache version in the three knowledge HTML pages.

This is a static website. These changes add multiple-video display; they do
not add an upload dashboard, authentication or server-side article storage.
