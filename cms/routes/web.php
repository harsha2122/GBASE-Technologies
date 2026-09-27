<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\TrackPageView;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])
    ->middleware(TrackPageView::class)
    ->name('home');
