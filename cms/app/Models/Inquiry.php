<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'page_source',
        'company',
        'name',
        'city',
        'country',
        'country_other',
        'email',
        'phone',
        'website',
        'message',
        'product_types',
        'pre_process',
        'freezing_equipment',
        'heating_equipment',
        'equipment_options',
        'product_type',
        'equipment_interest',
        'business_type',
        'production',
        'referral',
        'machine_serial_no',
        'part_lines',
        'is_handled',
    ];

    protected function casts(): array
    {
        return [
            'product_types' => 'array',
            'pre_process' => 'array',
            'freezing_equipment' => 'array',
            'heating_equipment' => 'array',
            'equipment_options' => 'array',
            'part_lines' => 'array',
            'is_handled' => 'boolean',
        ];
    }
}
