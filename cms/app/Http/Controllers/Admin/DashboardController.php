<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Partner;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_pages' => Page::count(),
            'published_pages' => Page::where('is_published', true)->count(),
            'total_forms' => Form::count(),
            'total_submissions' => FormSubmission::count(),
            'today_submissions' => FormSubmission::whereDate('created_at', today())->count(),
            'recent_submissions' => FormSubmission::with('form')->latest()->take(8)->get(),
            'total_galleries' => Gallery::count(),
            'total_blog_posts' => BlogPost::count(),
            'published_blogs' => BlogPost::where('is_published', true)->count(),
            'total_partners' => Partner::count(),
            'active_partners' => Partner::where('is_active', true)->count(),
        ];

        $submission_trend = FormSubmission::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard-material', compact('stats', 'submission_trend'));
    }
}
