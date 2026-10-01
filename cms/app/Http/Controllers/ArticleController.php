<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Page;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::where('is_published', true)
            ->orderByDesc('published_at')
            ->paginate(9);

        $brandSlider = $this->sharedBrandSlider();

        $listingPage = Page::where('slug', 'knowledge-articles')->first();
        $sections = $listingPage
            ? $listingPage->sections()
                ->get()
                ->keyBy('section_key')
                ->map(fn ($section) => [
                    'type' => $section->section_type,
                    'content' => $section->content ?? [],
                ])
            : collect();

        $page = $listingPage
            ? $this->metaFor($listingPage->meta_title, $listingPage->meta_description)
            : $this->metaFor(
                'Articles | GBASE Technologies',
                'Practical notes, guides, and insights from the GBASE team.'
            );

        return view('pages.knowledge-articles', compact('articles', 'brandSlider', 'page', 'sections'));
    }

    public function show(Article $article): View
    {
        abort_unless($article->is_published, 404);

        $related = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->orderByDesc('published_at')
            ->limit(3)
            ->get();

        $brandSlider = $this->sharedBrandSlider();
        $page = $this->metaFor(
            $article->title.' | GBASE Technologies',
            $article->excerpt ?? ''
        );

        return view('pages.article-show', compact('article', 'related', 'brandSlider', 'page'));
    }

    private function metaFor(string $title, string $description): object
    {
        return (object) [
            'meta_title' => $title,
            'meta_description' => $description,
        ];
    }

    private function sharedBrandSlider(): array
    {
        $section = Page::where('slug', 'home')
            ->first()
            ?->sections()
            ->where('section_key', 'brand_slider')
            ->first();

        return $section->content ?? [];
    }
}
