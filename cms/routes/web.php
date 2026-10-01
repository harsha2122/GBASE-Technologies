<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContentPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\TrackPageView;
use Illuminate\Support\Facades\Route;

Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::middleware(TrackPageView::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/consulting.html', [ContentPageController::class, 'consulting'])->name('consulting');
    Route::get('/spare_parts.html', [ContentPageController::class, 'spareParts'])->name('spare-parts');
    Route::get('/equipments.html', [ContentPageController::class, 'equipments'])->name('equipments');
    Route::get('/contact.html', [ContentPageController::class, 'contact'])->name('contact');

    Route::get('/knowledge-articles.html', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/knowledge-articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/knowledge-videos.html', [VideoController::class, 'index'])->name('videos.index');

    Route::get('/service.html', [ContentPageController::class, 'service'])->name('service');
    Route::get('/service/{detailSlug}.html', [ContentPageController::class, 'serviceDetail'])
        ->where('detailSlug', '[A-Za-z0-9_-]+')
        ->name('service.detail');

    Route::get('/freezing.html', [ContentPageController::class, 'freezingLanding'])->name('freezing.landing');
    Route::get('/heating.html', [ContentPageController::class, 'heatingLanding'])->name('heating.landing');
    Route::get('/{category}/{detailSlug}.html', [ContentPageController::class, 'equipmentDetail'])
        ->where('category', 'freezing|heating|process|sorting')
        ->where('detailSlug', '[A-Za-z0-9_-]+')
        ->name('equipment.detail');
});
