<?php

namespace Tests\Feature;

use App\Filament\Resources\VideoResource\Pages\CreateVideo;
use App\Filament\Resources\VideoResource\Pages\EditVideo;
use App\Models\User;
use App\Models\Video;
use App\Support\VideoPlayer;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class VideoUrlsTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['app.key' => 'base64:'.base64_encode(str_repeat('a', 32))]);
        Filament::setCurrentPanel(Filament::getPanel('admin'));
    }

    public function test_existing_single_video_is_preserved_and_prefilled_in_the_actual_admin_editor(): void
    {
        $this->actingAs(User::factory()->create());
        $video = $this->video(['video_url' => 'https://drive.google.com/file/d/existing-video/view?usp=sharing']);

        $component = Livewire::test(EditVideo::class, ['record' => $video->getRouteKey()]);
        $component->assertSuccessful()->assertFormSet(['title' => 'IQF Line Overview']);
        $this->assertSame(['https://drive.google.com/file/d/existing-video/view?usp=sharing'], array_column(array_values($component->get('data.video_urls')), 'url'));

        $this->assertSame(['https://drive.google.com/file/d/existing-video/view?usp=sharing'], $video->urls());
    }

    public function test_admin_can_save_five_urls_without_deleting_existing_video_thumbnail_or_tags(): void
    {
        $this->actingAs(User::factory()->create());
        Storage::fake('public');
        Storage::disk('public')->put('videos/original.png', base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII='));
        $video = $this->video(['video_url' => 'https://drive.google.com/file/d/original/view', 'thumbnail' => 'videos/original.png', 'tags' => ['IQF']]);
        $urls = ['https://drive.google.com/file/d/original/view', 'https://youtu.be/abcdefghijk', 'https://vimeo.com/123456789', 'https://cdn.example.com/demo.mp4', 'https://drive.google.com/file/d/second/view'];

        Livewire::test(EditVideo::class, ['record' => $video->getRouteKey()])
            ->fillForm(['video_urls' => $this->rows($urls)])->call('save')->assertHasNoFormErrors();

        $video->refresh();
        $this->assertSame($urls, $video->video_urls);
        $this->assertSame('https://drive.google.com/file/d/original/view', $video->video_url);
        $this->assertSame('videos/original.png', $video->thumbnail);
        Storage::disk('public')->assertExists('videos/original.png');
        $this->assertSame(['IQF'], $video->tags);
        $this->assertDatabaseCount('videos', 1);
    }

    public function test_six_urls_are_rejected_without_changing_existing_videos(): void
    {
        $this->actingAs(User::factory()->create());
        $video = $this->video(['video_url' => 'https://youtu.be/abcdefghijk']);

        Livewire::test(EditVideo::class, ['record' => $video->getRouteKey()])
            ->fillForm(['video_urls' => $this->rows(array_fill(0, 6, 'https://youtu.be/abcdefghijk'))])
            ->call('save')->assertHasFormErrors(['video_urls' => 'max']);

        $this->assertSame(['https://youtu.be/abcdefghijk'], $video->fresh()->urls());
    }

    public function test_admin_can_create_a_video_section_with_multiple_links(): void
    {
        $this->actingAs(User::factory()->create());
        $urls = ['https://youtu.be/abcdefghijk', 'https://drive.google.com/file/d/new-file/view'];

        Livewire::test(CreateVideo::class)->fillForm(['title' => 'New section', 'description' => 'Description', 'video_urls' => $this->rows($urls)])
            ->call('create')->assertHasNoFormErrors();

        $this->assertSame($urls, Video::sole()->video_urls);
    }

    public function test_admin_can_reorder_or_explicitly_remove_links(): void
    {
        $this->actingAs(User::factory()->create());
        $video = $this->video(['video_urls' => ['https://youtu.be/abcdefghijk', 'https://vimeo.com/123456789']]);

        Livewire::test(EditVideo::class, ['record' => $video->getRouteKey()])
            ->fillForm(['video_urls' => $this->rows(['https://vimeo.com/123456789'])])->call('save')->assertHasNoFormErrors();

        $this->assertSame(['https://vimeo.com/123456789'], $video->fresh()->urls());
        $this->assertDatabaseCount('videos', 1);
    }

    public function test_explicitly_clearing_the_list_does_not_restore_the_legacy_url(): void
    {
        $this->actingAs(User::factory()->create());
        $video = $this->video(['video_url' => 'https://youtu.be/abcdefghijk']);

        Livewire::test(EditVideo::class, ['record' => $video->getRouteKey()])
            ->fillForm(['video_urls' => []])->call('save')->assertHasNoFormErrors();

        $this->assertSame([], $video->fresh()->urls());
        $this->assertSame('https://youtu.be/abcdefghijk', $video->fresh()->video_url);
    }

    public function test_unsafe_urls_are_rejected_in_admin_without_saving(): void
    {
        $this->actingAs(User::factory()->create());
        $video = $this->video(['video_url' => 'https://youtu.be/abcdefghijk']);

        Livewire::test(EditVideo::class, ['record' => $video->getRouteKey()])
            ->fillForm(['video_urls' => $this->rows(['javascript:alert(1)'])])->call('save')->assertHasFormErrors();

        $this->assertSame(['https://youtu.be/abcdefghijk'], $video->fresh()->urls());
    }

    public function test_public_listing_keeps_one_card_and_shows_all_links_in_the_group(): void
    {
        $this->video(['video_urls' => ['https://drive.google.com/file/d/original/view?usp=sharing', 'https://youtu.be/abcdefghijk', 'https://cdn.example.com/demo.mp4']]);

        $response = $this->get(route('videos.index'))->assertOk()
            ->assertSee('3 videos')->assertSee('https://drive.google.com/file/d/original/preview')
            ->assertSee('https://www.youtube-nocookie.com/embed/abcdefghijk')->assertSee('https://cdn.example.com/demo.mp4');

        $this->assertSame(3, substr_count($response->getContent(), 'data-group-select '));
        $this->assertSame(1, substr_count($response->getContent(), 'post-card style-1'));
    }

    public function test_unpublished_sections_are_not_exposed(): void
    {
        $this->video(['is_published' => false, 'video_urls' => ['https://drive.google.com/file/d/private/view']]);

        $this->get(route('videos.index'))->assertOk()->assertDontSee('IQF Line Overview')->assertDontSee('drive.google.com/file/d/private');
    }

    public function test_video_editor_still_requires_login(): void
    {
        $video = $this->video(['video_url' => 'https://youtu.be/abcdefghijk']);

        $this->get('/admin/videos/'.$video->id.'/edit')->assertRedirect('/admin/login');
    }

    public function test_migration_preserves_original_single_urls_and_backfills_the_list(): void
    {
        $video = $this->video(['video_url' => 'https://drive.google.com/file/d/original/view']);
        $migration = require database_path('migrations/2026_10_28_063615_add_video_urls_to_videos_table.php');
        $migration->down();

        $migration->up();

        $this->assertSame('https://drive.google.com/file/d/original/view', DB::table('videos')->where('id', $video->id)->value('video_url'));
        $this->assertSame(['https://drive.google.com/file/d/original/view'], $video->fresh()->video_urls);
        $this->assertDatabaseCount('videos', 1);
    }

    #[DataProvider('playerSources')]
    public function test_video_links_use_the_correct_player_or_external_fallback(string $url, ?array $expected): void
    {
        $this->assertSame($expected, VideoPlayer::source($url));
    }

    public static function playerSources(): array
    {
        return [
            'drive share link' => ['https://drive.google.com/file/d/file_ABC-123/view?usp=sharing', ['type' => 'embed', 'src' => 'https://drive.google.com/file/d/file_ABC-123/preview']],
            'drive open link' => ['https://drive.google.com/open?id=file_ABC-123', ['type' => 'embed', 'src' => 'https://drive.google.com/file/d/file_ABC-123/preview']],
            'youtube share' => ['https://youtu.be/abcdefghijk?si=one', ['type' => 'embed', 'src' => 'https://www.youtube-nocookie.com/embed/abcdefghijk']],
            'youtube watch' => ['https://youtube.com/watch?v=abcdefghijk', ['type' => 'embed', 'src' => 'https://www.youtube-nocookie.com/embed/abcdefghijk']],
            'vimeo' => ['https://vimeo.com/123456789', ['type' => 'embed', 'src' => 'https://player.vimeo.com/video/123456789']],
            'signed mp4' => ['https://cdn.example.com/demo.mp4?token=one', ['type' => 'file', 'src' => 'https://cdn.example.com/demo.mp4?token=one']],
            'other host' => ['https://example.com/video-page', ['type' => 'link', 'src' => 'https://example.com/video-page']],
            'script rejected' => ['javascript:alert(1)', null],
            'html rejected' => ['data:text/html,<script>alert(1)</script>', null],
        ];
    }

    private function rows(array $urls): array
    {
        return array_map(fn (string $url): array => ['url' => $url], $urls);
    }

    private function video(array $attributes): Video
    {
        return Video::create(array_merge(['title' => 'IQF Line Overview', 'description' => 'A quick look at the production line.', 'sort_order' => 1, 'is_published' => true], $attributes));
    }
}
