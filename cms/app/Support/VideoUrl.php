<?php

namespace App\Support;

class VideoUrl
{
    /**
     * @return array{type: string, src: string}|null
     */
    public static function player(string $url): ?array
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return null;
        }

        $parts = parse_url($url);
        if (! in_array(strtolower($parts['scheme'] ?? ''), ['https', 'http'], true) || isset($parts['user']) || isset($parts['pass'])) {
            return null;
        }

        $host = strtolower($parts['host'] ?? '');
        $path = $parts['path'] ?? '';
        $youtubeId = null;
        if ($host === 'youtu.be') {
            $youtubeId = trim($path, '/');
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtube-nocookie.com', 'www.youtube-nocookie.com'], true)) {
            if ($path === '/watch') {
                parse_str($parts['query'] ?? '', $query);
                $youtubeId = $query['v'] ?? null;
            } elseif (preg_match('~^/(?:embed|shorts|live)/([\w-]+)/?$~', $path, $matches)) {
                $youtubeId = $matches[1];
            }
        }

        if (is_string($youtubeId) && preg_match('/^[a-zA-Z0-9_-]{11}$/', $youtubeId)) {
            return ['type' => 'embed', 'src' => 'https://www.youtube-nocookie.com/embed/'.$youtubeId];
        }

        if (in_array($host, ['vimeo.com', 'www.vimeo.com', 'player.vimeo.com'], true)
            && preg_match('~^/(?:video/)?([0-9]+)(?:/([a-zA-Z0-9]+))?/?$~', $path, $matches)) {
            parse_str($parts['query'] ?? '', $query);
            $hash = $matches[2] ?? $query['h'] ?? null;
            $suffix = is_string($hash) && preg_match('/^[a-zA-Z0-9]+$/', $hash) ? '?h='.$hash : '';

            return ['type' => 'embed', 'src' => 'https://player.vimeo.com/video/'.$matches[1].$suffix];
        }

        if (preg_match('/\.(mp4|webm|ogv|ogg)$/i', $path)) {
            return ['type' => 'file', 'src' => $url];
        }

        return null;
    }
}
