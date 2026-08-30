<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Http\Request;

class PageSectionController extends Controller
{
    public function store(Request $request, Page $page)
    {
        $data = $request->validate([
            'key' => ['nullable', 'string', 'max:100'],
            'type' => ['required', 'in:text,rich_text,image,card_group'],
            'heading' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);
        $data['page_id'] = $page->id;
        $data['sort_order'] = $data['sort_order'] ?? ($page->sections()->max('sort_order') + 1);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('sections', 'public');
        }

        PageSection::create($data);

        return back()->with('status', 'Section added.');
    }

    public function update(Request $request, Page $page, PageSection $section)
    {
        $data = $request->validate([
            'key' => ['nullable', 'string', 'max:100'],
            'type' => ['required', 'in:text,rich_text,image,card_group'],
            'heading' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('sections', 'public');
        }

        $section->update($data);

        return back()->with('status', 'Section updated.');
    }

    public function destroy(Page $page, PageSection $section)
    {
        $section->delete();
        return back()->with('status', 'Section deleted.');
    }
}
