<?php

namespace Tests\Feature;

use App\Rules\PlayableVideoUrl;
use App\Support\VideoUrl;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class VideoUrlTest extends TestCase
{
    #[DataProvider('videoSources')]
    public function test_supported_urls_resolve_to_playable_sources(string $url, string $type, string $source): void
    {
        $this->assertSame(['type' => $type, 'src' => $source], VideoUrl::player($url));
    }

    public static function videoSources(): array
    {
        return [
            'youtube watch' => ['https://www.youtube.com/watch?v=abcdefghijk&t=30', 'embed', 'https://www.youtube-nocookie.com/embed/abcdefghijk'],
            'youtube share' => ['https://youtu.be/abcdefghijk?si=tracking', 'embed', 'https://www.youtube-nocookie.com/embed/abcdefghijk'],
            'youtube shorts' => ['https://youtube.com/shorts/abcdefghijk', 'embed', 'https://www.youtube-nocookie.com/embed/abcdefghijk'],
            'youtube live' => ['https://youtube.com/live/abcdefghijk', 'embed', 'https://www.youtube-nocookie.com/embed/abcdefghijk'],
            'youtube embed' => ['https://www.youtube-nocookie.com/embed/abcdefghijk', 'embed', 'https://www.youtube-nocookie.com/embed/abcdefghijk'],
            'vimeo' => ['https://vimeo.com/123456789', 'embed', 'https://player.vimeo.com/video/123456789'],
            'private vimeo' => ['https://vimeo.com/123456789/abc123', 'embed', 'https://player.vimeo.com/video/123456789?h=abc123'],
            'vimeo embed' => ['https://player.vimeo.com/video/123456789?h=abc123', 'embed', 'https://player.vimeo.com/video/123456789?h=abc123'],
            'mp4 query preserved' => ['https://cdn.example.com/demo.mp4?signature=one', 'file', 'https://cdn.example.com/demo.mp4?signature=one'],
            'webm' => ['https://cdn.example.com/demo.webm', 'file', 'https://cdn.example.com/demo.webm'],
        ];
    }

    #[DataProvider('invalidSources')]
    public function test_unsupported_or_unsafe_urls_have_a_validation_message(string $url): void
    {
        $validation = Validator::make(['video_url' => $url], ['video_url' => ['required', new PlayableVideoUrl]]);

        $this->assertSame(['Enter a YouTube, Vimeo, or direct MP4/WebM video URL.'], $validation->errors()->get('video_url'));
    }

    public static function invalidSources(): array
    {
        return [
            'script' => ['javascript:alert(1)'],
            'html data' => ['data:text/html,<script>alert(1)</script>'],
            'credentials' => ['https://user:password@cdn.example.com/demo.mp4'],
            'fake youtube host' => ['https://youtube.com.evil.example/watch?v=abcdefghijk'],
            'array youtube id' => ['https://youtube.com/watch?v[]=abcdefghijk'],
            'missing youtube id' => ['https://youtube.com/watch'],
            'invalid youtube id' => ['https://youtu.be/short'],
            'arbitrary page' => ['https://example.com/article'],
            'ftp media' => ['ftp://example.com/demo.mp4'],
        ];
    }
}
