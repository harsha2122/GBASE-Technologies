<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = Page::where('is_published', true)
            ->get()
            ->map(fn (Page $page) => [
                'loc' => $page->publicUrl(),
                'lastmod' => $page->updated_at->toAtomString(),
            ]);

        $articleUrls = Article::where('is_published', true)
            ->get()
            ->map(fn (Article $article) => [
                'loc' => route('articles.show', $article->slug),
                'lastmod' => $article->updated_at->toAtomString(),
            ]);

        $urls = $urls->concat($articleUrls);

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'text/xml');
    }
}
