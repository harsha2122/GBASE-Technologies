<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Illuminate\Support\Carbon;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class VisitorsOverTimeChart extends ApexChartWidget
{
    protected static ?string $chartId = 'visitorsOverTimeChart';

    protected static ?string $heading = 'Visitors & Page Views (Last 14 Days)';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 2;

    protected function getOptions(): array
    {
        $days = collect(range(13, 0))->map(fn ($i) => today()->subDays($i));

        $views = PageView::selectRaw('date(viewed_at) as day, count(*) as views, count(distinct visitor_id) as visitors')
            ->where('viewed_at', '>=', today()->subDays(13))
            ->groupBy('day')
            ->pluck('views', 'day')
            ->toArray();

        $visitors = PageView::selectRaw('date(viewed_at) as day, count(distinct visitor_id) as visitors')
            ->where('viewed_at', '>=', today()->subDays(13))
            ->groupBy('day')
            ->pluck('visitors', 'day')
            ->toArray();

        $labels = $days->map(fn (Carbon $d) => $d->format('M j'));
        $viewsSeries = $days->map(fn (Carbon $d) => $views[$d->toDateString()] ?? 0);
        $visitorsSeries = $days->map(fn (Carbon $d) => $visitors[$d->toDateString()] ?? 0);

        return [
            'chart' => [
                'type' => 'area',
                'height' => 300,
                'toolbar' => ['show' => false],
            ],
            'series' => [
                [
                    'name' => 'Page Views',
                    'data' => $viewsSeries->values()->toArray(),
                ],
                [
                    'name' => 'Unique Visitors',
                    'data' => $visitorsSeries->values()->toArray(),
                ],
            ],
            'xaxis' => [
                'categories' => $labels->values()->toArray(),
                'labels' => ['style' => ['fontFamily' => 'inherit']],
            ],
            'yaxis' => [
                'labels' => ['style' => ['fontFamily' => 'inherit']],
            ],
            'colors' => ['#0072ff', '#cff480'],
            'stroke' => ['curve' => 'smooth', 'width' => 2],
            'fill' => [
                'type' => 'gradient',
                'gradient' => ['opacityFrom' => 0.45, 'opacityTo' => 0.05],
            ],
            'dataLabels' => ['enabled' => false],
            'legend' => ['position' => 'top'],
        ];
    }
}
