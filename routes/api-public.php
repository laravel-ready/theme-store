<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Api\Auth\AuthController;

use LaravelReady\ThemeStore\Http\Controllers\Api\Public\Theme\ThemeController;

Route::name('theme-store.api.')
    ->prefix(Config::get('theme-store.endpoints.api.prefix', 'api/theme-store'))
    ->middleware(Config::get('theme-store.endpoints.api.public_middleware', ['api']))
    ->group(function () {
        // public routes for web ui
        Route::name('public.')
            ->prefix('v1')
            ->group(function () {
                Route::name('auth.')->prefix('auth')
                    ->group(function () {
                        Route::post('login', [AuthController::class, 'login'])->name('login');
                    });
            });

        // public routes for client access
        Route::name('public.')
            ->prefix('public/v1')
            ->middleware(Config::get('theme-store.endpoints.api.private_middleware', ['api', 'auth:sanctum']))
            ->group(function () {
                Route::get('themes', [ThemeController::class, 'index'])->name('themes.index');
            });
    });
