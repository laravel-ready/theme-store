<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Web\StoreController;

Route::name('theme-store.web.')->prefix(Config::get('theme-store.endpoints.web.prefix', 'theme-store'))
    ->middleware(Config::get('theme-store.endpoints.web.middleware', ['web', 'theme-store-public']))
    ->group(function () {
        Route::get('', [StoreController::class, 'index'])->name('index');
        Route::get('search/{keyword}', [StoreController::class, 'search'])->name('search');

        Route::prefix('category')->name('category.')->group(function () {
            Route::get('', [StoreController::class, 'index'])->name('index');
            Route::get('{category}', [StoreController::class, 'details'])->name('details');
        });
    });
