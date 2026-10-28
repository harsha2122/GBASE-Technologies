<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('inquiries', function (Request $request): array {
            $ip = hash('sha256', (string) $request->ip());

            return [
                Limit::perMinutes(10, 5)->by('inquiry-burst:'.$ip),
                Limit::perHour(20)->by('inquiry-hour:'.$ip),
            ];
        });

        View::composer(['partials.header', 'partials.footer'], function ($view): void {
            $view->with('settings', Setting::current());
        });
    }
}
