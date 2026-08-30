<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\PageSection;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('section.page')->latest()->paginate(20);
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        $sections = PageSection::with('page')->get();
        return view('admin.gallery.form', compact('sections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_section_id' => 'nullable|exists:page_sections,id',
            'image' => 'required|image|max:5120',
            'caption' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('gallery', 'public');
        Gallery::create([
            'page_section_id' => $validated['page_section_id'],
            'image_path' => $path,
            'caption' => $validated['caption'],
            'alt_text' => $validated['alt_text'],
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added.');
    }

    public function edit(Gallery $gallery)
    {
        $sections = PageSection::with('page')->get();
        return view('admin.gallery.form', compact('gallery', 'sections'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'page_section_id' => 'nullable|exists:page_sections,id',
            'image' => 'nullable|image|max:5120',
            'caption' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('gallery', 'public');
            $validated['image_path'] = $path;
        }

        $gallery->update($validated);
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery updated.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return back()->with('success', 'Gallery image deleted.');
    }
}
