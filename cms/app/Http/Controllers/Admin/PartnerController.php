<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->paginate(20);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'logo' => 'required|image|max:2048',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('partners', 'public');
        }

        unset($validated['logo']);
        Partner::create($validated);
        return redirect()->route('admin.partners.index')->with('success', 'Partner added.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.form', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'logo' => 'nullable|image|max:2048',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo_path'] = $request->file('logo')->store('partners', 'public');
        }

        unset($validated['logo']);
        $partner->update($validated);
        return redirect()->route('admin.partners.index')->with('success', 'Partner updated.');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return back()->with('success', 'Partner deleted.');
    }

    public function reorder(Request $request)
    {
        foreach ($request->get('order', []) as $order => $id) {
            Partner::find($id)?->update(['sort_order' => $order]);
        }
        return response()->json(['success' => true]);
    }
}
