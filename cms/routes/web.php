<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\FormSubmissionController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\FormSubmitController;
use App\Http\Controllers\PublicPageController;
use Illuminate\Support\Facades\Route;

// -----------------------------------------------------------------------
// Public site
// -----------------------------------------------------------------------
Route::get('/', [PublicPageController::class, 'show'])->defaults('slug', 'home');
Route::post('/forms/{form}/submit', [FormSubmitController::class, 'store'])->name('forms.submit');

// -----------------------------------------------------------------------
// Admin auth
// -----------------------------------------------------------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.attempt');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', fn () => redirect()->route('admin.pages.index'))->name('dashboard');

        Route::resource('pages', PageController::class)->except(['show']);
        Route::post('pages/{page}/sections', [PageSectionController::class, 'store'])->name('pages.sections.store');
        Route::put('pages/{page}/sections/{section}', [PageSectionController::class, 'update'])->name('pages.sections.update');
        Route::delete('pages/{page}/sections/{section}', [PageSectionController::class, 'destroy'])->name('pages.sections.destroy');

        Route::post('sections/{section}/cards', [CardController::class, 'store'])->name('sections.cards.store');
        Route::put('sections/{section}/cards/{card}', [CardController::class, 'update'])->name('sections.cards.update');
        Route::delete('sections/{section}/cards/{card}', [CardController::class, 'destroy'])->name('sections.cards.destroy');

        Route::resource('forms', FormController::class)->except(['show']);
        Route::post('forms/{form}/fields', [FormController::class, 'storeField'])->name('forms.fields.store');
        Route::put('forms/{form}/fields/{field}', [FormController::class, 'updateField'])->name('forms.fields.update');
        Route::delete('forms/{form}/fields/{field}', [FormController::class, 'destroyField'])->name('forms.fields.destroy');

        Route::get('forms/{form}/submissions', [FormSubmissionController::class, 'index'])->name('forms.submissions.index');
        Route::get('forms/{form}/submissions/{submission}', [FormSubmissionController::class, 'show'])->name('forms.submissions.show');
    });
});

// Catch-all: any other path resolves to a page by its slug (e.g. "process/used-equipments")
Route::get('/{slug}', [PublicPageController::class, 'show'])->where('slug', '.*');
