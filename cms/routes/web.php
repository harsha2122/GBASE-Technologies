<?php

use App\Http\Controllers\ContentPageController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\TrackPageView;
use Illuminate\Support\Facades\Route;

Route::middleware(TrackPageView::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/consulting.html', [ContentPageController::class, 'consulting'])->name('consulting');
    Route::get('/spare_parts.html', [ContentPageController::class, 'spareParts'])->name('spare-parts');
    Route::get('/equipments.html', [ContentPageController::class, 'equipments'])->name('equipments');
});
