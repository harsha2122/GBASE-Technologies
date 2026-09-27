<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->method() === 'GET' && ! $request->ajax() && $response->getStatusCode() < 400) {
            $this->recordView($request);
        }

        return $response;
    }

    private function recordView(Request $request): void
    {
        $visitorId = $request->cookie('gbase_visitor_id') ?? (string) Str::uuid();

        $agent = new Agent;
        $agent->setUserAgent($request->userAgent());

        PageView::create([
            'path' => $request->path() === '/' ? '/' : '/'.ltrim($request->path(), '/'),
            'visitor_id' => $visitorId,
            'session_id' => $request->session()->getId(),
            'referrer' => $request->headers->get('referer'),
            'device_type' => $agent->isMobile() ? 'mobile' : ($agent->isTablet() ? 'tablet' : 'desktop'),
            'browser' => $agent->browser() ?: 'Unknown',
            'platform' => $agent->platform() ?: 'Unknown',
            'viewed_at' => now(),
        ]);

        if (! $request->cookie('gbase_visitor_id')) {
            cookie()->queue(cookie('gbase_visitor_id', $visitorId, 60 * 24 * 365));
        }
    }
}
