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

        // public routes
        Route::name('public.')
            ->middleware(Config::get('theme-store.endpoints.api.public_middleware', ['api']))
            ->group(function () {
            });

        // private routes
        Route::name('private.')
            ->prefix('private')
            ->middleware(Config::get('theme-store.endpoints.api.private_middleware', ['api', 'auth:sanctum']))
            ->group(function () {

                Route::name('auth.')->prefix('auth')->group(function () {
                    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
                    Route::get('me', [AuthController::class, 'me'])->name('me');
                });

                Route::resource('category', CategoryController::class)->parameters(['' => 'id']);
            });
    });
