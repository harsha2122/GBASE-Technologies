<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class TopPagesChart extends ApexChartWidget
{
    protected static ?string $chartId = 'topPagesChart';

    protected static ?string $heading = 'Top Visited Pages';

    protected static ?int $sort = 3;

    protected function getOptions(): array
    {
        $top = PageView::selectRaw('path, count(*) as total')
            ->groupBy('path')
            ->orderByDesc('total')
            ->limit(8)
            ->pluck('total', 'path');

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 300,
                'toolbar' => ['show' => false],
            ],
            'plotOptions' => [
                'bar' => ['horizontal' => true, 'borderRadius' => 4],
            ],
            'series' => [
                ['name' => 'Page Views', 'data' => $top->values()->toArray()],
            ],
            'xaxis' => [
                'categories' => $top->keys()->toArray(),
            ],
            'colors' => ['#0072ff'],
            'dataLabels' => ['enabled' => false],
        ];
    }
}
