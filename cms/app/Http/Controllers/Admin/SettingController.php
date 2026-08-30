<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:100',
            'site_description' => 'nullable|string|max:500',
            'site_logo' => 'nullable|image|max:2048',
            'site_favicon' => 'nullable|image|max:512',
            'contact_email' => 'required|email|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:300',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
        ]);

        foreach ($validated as $key => $value) {
            if ($key === 'site_logo' && $request->hasFile('site_logo')) {
                Setting::set('site_logo', $request->file('site_logo')->store('settings', 'public'));
            } elseif ($key === 'site_favicon' && $request->hasFile('site_favicon')) {
                Setting::set('site_favicon', $request->file('site_favicon')->store('settings', 'public'));
            } else {
                Setting::set($key, $value);
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
