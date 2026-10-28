<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Page;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

class PublicBlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::where('is_published', true)->latest('published_at')->paginate(12);

        return $this->listing($posts, false);
    }

    public function videos(): View
    {
        $posts = BlogPost::where('is_published', true)
            ->whereNotNull('video_urls')->whereJsonLength('video_urls', '>', 0)
            ->latest('published_at')->paginate(12);

        return $this->listing($posts, true);
    }

    private function listing(LengthAwarePaginator $posts, bool $videosOnly): View
    {
        $page = Page::where('slug', $videosOnly ? 'knowledge-videos' : 'knowledge-articles')
            ->with(['sections.cards', 'forms.fields'])->first();
        if ($page !== null) {
            abort_unless($page->is_published, 404);

            return view('public.page', compact('page', 'posts', 'videosOnly'));
        }

        return view('public.knowledge-index', compact('posts', 'videosOnly'));
    }

    public function show(BlogPost $post): View
    {
        abort_unless($post->is_published, 404);
        $post->incrementViews();

        return view('public.knowledge-show', ['post' => $post, 'videos' => $post->playableVideos()]);
    }
}
