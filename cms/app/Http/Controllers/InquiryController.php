<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'page_source' => ['nullable', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'country_other' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'website' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'product_types' => ['nullable', 'array'],
            'pre_process' => ['nullable', 'array'],
            'freezing_equipment' => ['nullable', 'array'],
            'heating_equipment' => ['nullable', 'array'],
            'equipment_options' => ['nullable', 'array'],
            'product_type' => ['nullable', 'string', 'max:255'],
            'equipment_interest' => ['nullable', 'string', 'max:255'],
            'business_type' => ['nullable', 'string', 'max:255'],
            'production' => ['nullable', 'string', 'max:255'],
            'referral' => ['nullable', 'string', 'max:255'],
        ]);

        Inquiry::create($data);

        return back()->with('inquiry_sent', true);
    }
}
