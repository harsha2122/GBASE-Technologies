<?php

namespace App\Filament\Widgets;

use App\Models\PageView;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AnalyticsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $today = PageView::whereDate('viewed_at', today())->count();
        $todayVisitors = PageView::whereDate('viewed_at', today())->distinct('visitor_id')->count('visitor_id');

        $last7Days = PageView::where('viewed_at', '>=', now()->subDays(7))->count();
        $last7DaysVisitors = PageView::where('viewed_at', '>=', now()->subDays(7))->distinct('visitor_id')->count('visitor_id');

        $totalViews = PageView::count();
        $totalVisitors = PageView::distinct('visitor_id')->count('visitor_id');

        return [
            Stat::make('Visitors Today', $todayVisitors)
                ->description($today.' page views today')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),

            Stat::make('Visitors (7 days)', $last7DaysVisitors)
                ->description($last7Days.' page views this week')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('primary'),

            Stat::make('All-Time Visitors', $totalVisitors)
                ->description($totalViews.' total page views')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning'),
        ];
    }
}
