<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class DeviceBreakdownChart extends ApexChartWidget
{
    protected static ?string $chartId = 'deviceBreakdownChart';

    protected static ?string $heading = 'Visits by Device';

    protected static ?int $sort = 4;

    protected function getOptions(): array
    {
        $data = PageView::selectRaw('device_type, count(*) as total')
            ->groupBy('device_type')
            ->pluck('total', 'device_type');

        return [
            'chart' => [
                'type' => 'donut',
                'height' => 300,
            ],
            'series' => $data->values()->toArray(),
            'labels' => $data->keys()->map(fn ($k) => ucfirst($k ?? 'Unknown'))->toArray(),
            'colors' => ['#0072ff', '#cff480', '#071b3a'],
            'legend' => ['position' => 'bottom'],
        ];
    }
}
