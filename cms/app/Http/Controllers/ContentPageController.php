<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class ContentPageController extends Controller
{
    public function show(string $slug, string $view): View
    {
        $page = Page::with('sections')->where('slug', $slug)->firstOrFail();

        $sections = $page->sections
            ->where('is_active', true)
            ->keyBy('section_key')
            ->map(fn ($section) => [
                'type' => $section->section_type,
                'content' => $section->content ?? [],
            ]);

        return view($view, [
            'page' => $page,
            'sections' => $sections,
            'brandSlider' => $this->sharedBrandSlider(),
        ]);
    }

    /**
     * The client logo marquee is managed once, on the Home page,
     * and reused across every other page so it's never out of sync.
     */
    private function sharedBrandSlider(): array
    {
        $section = Page::where('slug', 'home')
            ->first()
            ?->sections()
            ->where('section_key', 'brand_slider')
            ->first();

        return $section->content ?? [];
    }

    public function consulting(): View
    {
        return $this->show('consulting', 'pages.consulting');
    }

    public function spareParts(): View
    {
        return $this->show('spare-parts', 'pages.spare-parts');
    }

    public function equipments(): View
    {
        return $this->show('equipments', 'pages.equipments');
    }

    public function freezingLanding(): View
    {
        return $this->show('freezing-landing', 'pages.equipment-detail');
    }

    public function heatingLanding(): View
    {
        return $this->show('heating-landing', 'pages.equipment-detail');
    }

    public function equipmentDetail(string $category, string $detailSlug): View
    {
        $slug = $category.'-'.str_replace('_', '-', $detailSlug);

        return $this->show($slug, 'pages.equipment-detail');
    }

    public function contact(): View
    {
        return $this->show('contact', 'pages.contact');
    }

    public function service(): View
    {
        return $this->show('service', 'pages.service');
    }

    public function serviceDetail(string $detailSlug): View
    {
        return $this->show("service-{$detailSlug}", 'pages.service-detail');
    }
}
