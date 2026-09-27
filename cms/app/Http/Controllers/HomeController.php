<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $page = Page::with('sections')->where('slug', 'home')->firstOrFail();

        $sections = $page->sections
            ->where('is_active', true)
            ->keyBy('section_key')
            ->map(fn ($section) => [
                'type' => $section->section_type,
                'content' => $section->content ?? [],
            ]);

        return view('home', [
            'page' => $page,
            'sections' => $sections,
        ]);
    }
}
