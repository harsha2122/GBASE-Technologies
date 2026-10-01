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
            'company' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'country_other' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
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
            'machine_serial_no' => ['nullable', 'string', 'max:255'],
            'others_specify' => ['nullable', 'string', 'max:255'],
            'part_serial_no' => ['nullable', 'array'],
            'part_serial_no.*' => ['nullable', 'string', 'max:255'],
            'quantity_required' => ['nullable', 'array'],
            'quantity_required.*' => ['nullable', 'integer', 'min:1'],
        ]);

        $partLines = collect($data['part_serial_no'] ?? [])
            ->map(fn ($serial, $i) => [
                'serial_no' => $serial,
                'quantity' => $data['quantity_required'][$i] ?? null,
            ])
            ->filter(fn ($line) => filled($line['serial_no']))
            ->values()
            ->all();

        unset($data['part_serial_no'], $data['quantity_required']);

        $data['part_lines'] = $partLines ?: null;

        if (filled($data['others_specify'] ?? null)) {
            $data['message'] = trim(($data['message'] ?? '')."\nOthers: ".$data['others_specify']);
        }

        unset($data['others_specify']);

        Inquiry::create($data);

        return back()->with('inquiry_sent', true);
    }
}
