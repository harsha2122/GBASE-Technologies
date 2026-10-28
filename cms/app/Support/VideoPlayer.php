<?php

namespace App\Support;

class VideoPlayer
{
    /** @return array{type: string, src: string}|null */
    public static function source(string $url): ?array
    {
        if (! filter_var($url, FILTER_VALIDATE_URL)) {
            return null;
        }
        $parts = parse_url($url);
        if (! in_array(strtolower($parts['scheme'] ?? ''), ['http', 'https'], true) || isset($parts['user']) || isset($parts['pass'])) {
            return null;
        }
        $host = strtolower($parts['host'] ?? '');
        $path = $parts['path'] ?? '';
        parse_str($parts['query'] ?? '', $query);

        if ($host === 'drive.google.com') {
            $id = $query['id'] ?? null;
            if (preg_match('~^/file/d/([a-zA-Z0-9_-]+)(?:/|$)~', $path, $match)) {
                $id = $match[1];
            }
            if (is_string($id) && preg_match('/^[a-zA-Z0-9_-]+$/', $id)) {
                $resourceKey = $query['resourcekey'] ?? null;
                $suffix = is_string($resourceKey) && preg_match('/^[a-zA-Z0-9_-]+$/', $resourceKey) ? '?resourcekey='.$resourceKey : '';

                return ['type' => 'embed', 'src' => 'https://drive.google.com/file/d/'.$id.'/preview'.$suffix];
            }
        }
        $id = null;
        if ($host === 'youtu.be') {
            $id = trim($path, '/');
        } elseif (in_array($host, ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'www.youtube-nocookie.com'], true)) {
            $id = $path === '/watch' ? ($query['v'] ?? null) : null;
            if (preg_match('~^/(?:embed|shorts|live)/([a-zA-Z0-9_-]+)/?$~', $path, $match)) {
                $id = $match[1];
            }
        }
        if (is_string($id) && preg_match('/^[a-zA-Z0-9_-]{11}$/', $id)) {
            return ['type' => 'embed', 'src' => 'https://www.youtube-nocookie.com/embed/'.$id];
        }
        if (in_array($host, ['vimeo.com', 'www.vimeo.com', 'player.vimeo.com'], true)
            && preg_match('~^/(?:video/)?([0-9]+)(?:/([a-zA-Z0-9]+))?/?$~', $path, $match)) {
            $hash = $match[2] ?? $query['h'] ?? null;
            $suffix = is_string($hash) && preg_match('/^[a-zA-Z0-9]+$/', $hash) ? '?h='.$hash : '';

            return ['type' => 'embed', 'src' => 'https://player.vimeo.com/video/'.$match[1].$suffix];
        }
        if (preg_match('/\.(mp4|webm|ogv|ogg)$/i', $path)) {
            return ['type' => 'file', 'src' => $url];
        }

        return ['type' => 'link', 'src' => $url];
    }
}
