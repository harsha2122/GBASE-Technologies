<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PublicPageController extends Controller
{
    public function show(string $slug = 'home')
    {
        $page = Page::where('slug', $slug)
            ->where('is_published', true)
            ->with(['sections.cards', 'forms.fields'])
            ->firstOrFail();

        return view('public.page', compact('page'));
    }
}
