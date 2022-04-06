<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Panel\Category\CategoryController;
use LaravelReady\ThemeStore\Http\Controllers\Api\Private\Auth\AuthController;

Route::name('theme-store.api.')
    ->prefix(Config::get('theme-store.endpoints.api.prefix', 'api/theme-store'))
    ->group(function () {
        Route::name('auth.')->prefix('auth')->group(function () {
            Route::post('login', [AuthController::class, 'login'])->name('login');
        });

        // public routes for web ui
        Route::name('public.')
            ->prefix('v1')
            ->middleware(Config::get('theme-store.endpoints.api.public_middleware', ['api']))
            ->group(function () { });

        // private routes for panel
        Route::name('private.')
            ->prefix('private/v1')
            ->middleware(Config::get('theme-store.endpoints.api.private_middleware', ['api', 'auth:sanctum']))
            ->group(function () {
                // axios startpoint route
                Route::name('startpoint')->get('', '');

                Route::name('auth.')->prefix('auth')->group(function () {
                    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
                    Route::get('me', [AuthController::class, 'me'])->name('me');
                });

                Route::resource('category', CategoryController::class)->parameters(['' => 'id']);
            });
    });
