<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Video;
use Illuminate\View\View;

class VideoController extends Controller
{
    public function index(): View
    {
        $videos = Video::where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        $page = Page::with('sections')->where('slug', 'knowledge-videos')->first();

        $sections = $page
            ? $page->sections
                ->where('is_active', true)
                ->keyBy('section_key')
                ->map(fn ($section) => [
                    'type' => $section->section_type,
                    'content' => $section->content ?? [],
                ])
            : collect();

        $brandSlider = $this->sharedBrandSlider();

        $pageMeta = $page ?? (object) [
            'meta_title' => 'Videos | GBASE Technologies',
            'meta_description' => 'Short demos, walkthroughs, and service tips from our team.',
        ];

        return view('pages.knowledge-videos', [
            'videos' => $videos,
            'sections' => $sections,
            'brandSlider' => $brandSlider,
            'page' => $pageMeta,
        ]);
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
