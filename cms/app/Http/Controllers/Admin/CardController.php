<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\PageSection;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request, PageSection $section)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
        $data['page_section_id'] = $section->id;
        $data['sort_order'] = $data['sort_order'] ?? ($section->cards()->max('sort_order') + 1);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('cards', 'public');
        }
        unset($data['image']);

        Card::create($data);

        return back()->with('status', 'Card added.');
    }

    public function update(Request $request, PageSection $section, Card $card)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('cards', 'public');
        }
        unset($data['image']);

        $card->update($data);

        return back()->with('status', 'Card updated.');
    }

    public function destroy(PageSection $section, Card $card)
    {
        $card->delete();
        return back()->with('status', 'Card deleted.');
    }
}
