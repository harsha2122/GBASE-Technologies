<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\BlogPost;
use App\Models\Page;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class ArticleVideosTest extends TestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['app.key' => 'base64:'.base64_encode(str_repeat('a', 32))]);
    }

    public function test_admin_can_create_article_with_multiple_video_urls_in_order(): void
    {
        $this->login();
        $urls = ['https://youtu.be/abcdefghijk', 'https://vimeo.com/123456789', 'https://cdn.example.com/demo.mp4'];

        $this->post(route('admin.blog.store'), ['title' => 'Demo article', 'content' => 'Article text', 'is_published' => '1', 'video_urls' => $urls])
            ->assertRedirect(route('admin.blog.index'));

        $post = BlogPost::sole();
        $this->assertSame($urls, $post->video_urls);
        $this->assertTrue($post->is_published);
        $this->assertNotNull($post->published_at);
        $this->get(route('admin.blog.edit', $post))->assertOk()
            ->assertSee('Add another video URL')->assertSee('https://vimeo.com/123456789');
    }

    public function test_admin_can_replace_reorder_and_remove_video_urls_without_creating_another_article(): void
    {
        $this->login();
        $post = $this->article(['https://youtu.be/abcdefghijk', 'https://vimeo.com/123456789']);
        $urls = ['https://vimeo.com/123456789', 'https://cdn.example.com/second.webm'];

        $this->put(route('admin.blog.update', $post), ['title' => $post->title, 'content' => $post->content, 'is_published' => '1', 'video_urls' => $urls])
            ->assertRedirect(route('admin.blog.index'));

        $this->assertSame($urls, $post->fresh()->video_urls);
        $this->assertDatabaseCount('blog_posts', 1);
    }

    public function test_blank_video_rows_clear_all_videos_and_can_unpublish_article(): void
    {
        $this->login();
        $post = $this->article(['https://youtu.be/abcdefghijk']);

        $this->put(route('admin.blog.update', $post), ['title' => $post->title, 'content' => $post->content, 'is_published' => '0', 'video_urls' => ['', null]])
            ->assertRedirect(route('admin.blog.index'));

        $this->assertSame([], $post->fresh()->video_urls);
        $this->assertFalse($post->fresh()->is_published);
    }

    public function test_updating_without_video_fields_preserves_existing_urls(): void
    {
        $this->login();
        $post = $this->article(['https://youtu.be/abcdefghijk']);

        $this->put(route('admin.blog.update', $post), ['title' => 'Updated article', 'content' => $post->content, 'is_published' => '1'])
            ->assertRedirect(route('admin.blog.index'));

        $this->assertSame(['https://youtu.be/abcdefghijk'], $post->fresh()->video_urls);
    }

    #[DataProvider('invalidLists')]
    public function test_invalid_video_input_returns_validation_errors_without_changing_the_article(mixed $urls, string $error): void
    {
        $this->login();
        $post = $this->article(['https://youtu.be/abcdefghijk']);

        $this->putJson(route('admin.blog.update', $post), ['title' => $post->title, 'content' => $post->content, 'is_published' => '1', 'video_urls' => $urls])
            ->assertUnprocessable()->assertJsonValidationErrors($error);

        $this->assertSame(['https://youtu.be/abcdefghijk'], $post->fresh()->video_urls);
    }

    public static function invalidLists(): array
    {
        return [
            'list required' => ['https://youtu.be/abcdefghijk', 'video_urls'],
            'nested arrays rejected' => [[['https://youtu.be/abcdefghijk']], 'video_urls.0'],
            'script URL rejected' => [['javascript:alert(1)'], 'video_urls.0'],
            'ordinary webpage rejected' => [['https://example.com/article'], 'video_urls.0'],
            'oversized URL rejected' => [['https://example.com/'.str_repeat('a', 2048).'.mp4'], 'video_urls.0'],
        ];
    }

    public function test_validation_error_redisplays_all_video_urls(): void
    {
        $this->login();
        $post = $this->article([]);
        $edit = route('admin.blog.edit', $post);

        $this->from($edit)->put(route('admin.blog.update', $post), ['title' => '', 'content' => 'Text', 'video_urls' => ['https://youtu.be/abcdefghijk', 'not-a-url']])
            ->assertRedirect($edit)->assertSessionHasErrors('title');
        $this->get($edit)->assertOk()->assertSee('https://youtu.be/abcdefghijk')->assertSee('not-a-url');
    }

    public function test_published_article_renders_one_player_and_three_video_choices(): void
    {
        $post = $this->article(['https://youtu.be/abcdefghijk', 'https://vimeo.com/123456789', 'https://cdn.example.com/demo.mp4']);

        $response = $this->get(route('knowledge.show', $post))->assertOk()
            ->assertSee('3 videos')->assertSee('Video 1 of 3')
            ->assertSee('https://www.youtube-nocookie.com/embed/abcdefghijk')
            ->assertSee('https://player.vimeo.com/video/123456789');

        $this->assertSame(3, substr_count($response->getContent(), 'data-select-video '));
        $this->assertSame(1, substr_count($response->getContent(), '<iframe '));
        $this->assertSame(1, $post->fresh()->views);
    }

    public function test_article_without_videos_still_displays_content_without_a_broken_player(): void
    {
        $post = $this->article(null);

        $this->get(route('knowledge.show', $post))->assertOk()
            ->assertSee('Article text')->assertSee('0 videos')
            ->assertDontSee('data-article-videos', false);
    }

    public function test_drafts_are_not_public_or_included_in_knowledge_listings(): void
    {
        $post = $this->article(['https://youtu.be/abcdefghijk']);
        $post->update(['is_published' => false]);

        $this->get(route('knowledge.show', $post))->assertNotFound();
        $this->get(route('knowledge.articles'))->assertOk()->assertDontSee('Demo article');
        $this->get(route('knowledge.videos'))->assertOk()->assertDontSee('Demo article');
        $this->assertSame(0, $post->fresh()->views);
    }

    public function test_knowledge_listings_link_to_published_articles_and_show_counts(): void
    {
        $post = $this->article(['https://youtu.be/abcdefghijk', 'https://vimeo.com/123456789']);

        $this->get(route('knowledge.articles'))->assertOk()->assertSee('2 videos')->assertSee(route('knowledge.show', $post));
        $this->get(route('knowledge.videos'))->assertOk()->assertSee('2 videos')->assertSee('Demo article');
    }

    public function test_existing_knowledge_page_content_is_preserved_alongside_new_article_cards(): void
    {
        $this->article(['https://youtu.be/abcdefghijk']);
        $page = Page::create(['slug' => 'knowledge-articles', 'title' => 'Knowledge Centre', 'is_published' => true]);
        $page->sections()->create(['type' => 'rich_text', 'body' => '<p>Existing knowledge content</p>']);

        $this->get(route('knowledge.articles'))->assertOk()
            ->assertSee('Existing knowledge content')->assertSee('Demo article')->assertSee('1 video');
    }

    public function test_video_listing_excludes_articles_with_no_video_urls(): void
    {
        $this->article([]);

        $this->get(route('knowledge.videos'))->assertOk()->assertDontSee('Demo article');
    }

    public function test_visitors_cannot_add_or_update_article_urls(): void
    {
        $post = $this->article([]);

        $this->post(route('admin.blog.store'), ['title' => 'Unauthorized'])->assertRedirect(route('admin.login'));
        $this->put(route('admin.blog.update', $post), ['video_urls' => ['https://youtu.be/abcdefghijk']])->assertRedirect(route('admin.login'));
        $this->assertSame([], $post->fresh()->video_urls);
    }

    private function login(): void
    {
        $this->actingAs(Admin::create(['email' => 'admin@example.com', 'password' => 'unused']), 'admin');
    }

    private function article(?array $urls): BlogPost
    {
        return BlogPost::create(['title' => 'Demo article', 'slug' => 'demo-article', 'content' => 'Article text', 'is_published' => true, 'published_at' => now(), 'video_urls' => $urls]);
    }
}
