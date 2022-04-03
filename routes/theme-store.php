<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Api\Public\StoreController as ApiPublicStoreController;
use LaravelReady\ThemeStore\Http\Controllers\Api\Private\StoreController as ApiPrivateStoreController;
use LaravelReady\ThemeStore\Http\Controllers\Web\StoreController as WebStoreController;
use LaravelReady\ThemeStore\Http\Controllers\Panel\StoreController as PanelStoreController;
use LaravelReady\ThemeStore\Http\Controllers\Panel\PanelController;

Route::name('theme-store.')->group(function () {
    // Web Store
    Route::name('web.')
        ->prefix(Config::get('theme-store.endpoints.web.prefix', 'theme-store'))
        ->middleware(Config::get('theme-store.endpoints.web.middleware', ['web', 'theme-store-public']))->group(function () {
            Route::get('', [WebStoreController::class, 'index'])->name('index');
            Route::get('search/{keyword}', [WebStoreController::class, 'search'])->name('search');
        });

    // API (public)
    Route::name('api.public.')
        ->prefix(Config::get('theme-store.endpoints.api_public.prefix', 'api/theme-store'))
        ->middleware(Config::get('theme-store.endpoints.api_public.middleware', ['api']))->group(function () {
            Route::get('', [ApiPublicStoreController::class, 'index'])->name('index');
        });

    // API (private)
    Route::name('api.private.')
        ->prefix(Config::get('theme-store.endpoints.api_private.prefix', 'api/private/theme-store'))
        ->middleware(Config::get('theme-store.endpoints.api_private.middleware', ['api', 'auth']))->group(function () {
            Route::resource('', ApiPrivateStoreController::class)->parameters(['' => 'id']);
        });

    // Panel
    Route::name('panel.')
        ->prefix(Config::get('theme-store.endpoints.panel.prefix', 'theme-store/panel'))
        ->middleware(Config::get('theme-store.endpoints.panel.middleware', ['web', 'auth']))->group(function () {
            Route::get('', [PanelController::class, 'index']);
        });
});
