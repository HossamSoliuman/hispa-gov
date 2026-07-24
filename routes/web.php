<?php

use App\Http\Controllers\Auth\GovernmentLoginController;
use App\Http\Controllers\GovernmentPortalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'government.dashboard' : 'login');
});

Route::prefix('ar/gov')->group(function (): void {
    Route::middleware('guest')->group(function (): void {
        Route::get('/login', [GovernmentLoginController::class, 'create'])->name('login');
        Route::post('/login', [GovernmentLoginController::class, 'store'])
            ->middleware('throttle:government-login')
            ->name('login.store');
    });

    Route::middleware(['auth', 'can:access-government-portal'])
        ->name('government.')
        ->group(function (): void {
            Route::redirect('/', '/ar/gov/dashboard');
            Route::post('/logout', [GovernmentLoginController::class, 'destroy'])->name('logout');
            Route::get('/dashboard', [GovernmentPortalController::class, 'dashboard'])->name('dashboard');
            Route::post('/dashboard/refresh', [GovernmentPortalController::class, 'refreshDashboard'])->name('dashboard.refresh');
            Route::get('/region_production', [GovernmentPortalController::class, 'production'])->name('production');
            Route::get('/seasons', [GovernmentPortalController::class, 'seasons'])->name('seasons.index');
            Route::get('/seasons/create', [GovernmentPortalController::class, 'createSeason'])->name('seasons.create');
            Route::post('/seasons', [GovernmentPortalController::class, 'storeSeason'])->name('seasons.store');
            Route::get('/fish_report', [GovernmentPortalController::class, 'fishTypes'])->name('fish-types');
            Route::get('/captains', [GovernmentPortalController::class, 'workforce'])->name('workforce');
            Route::get('/fishing_tools', [GovernmentPortalController::class, 'fishingTools'])->name('fishing-tools.index');
            Route::post('/fishing_tools', [GovernmentPortalController::class, 'storeFishingTool'])->name('fishing-tools.store');
        });
});
