<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Web\StoreController;
use LaravelReady\ThemeStore\Http\Controllers\Web\CategoryController;

Route::name('theme-store.web.')->prefix(Config::get('theme-store.endpoints.web.prefix', 'theme-store'))
    ->middleware(Config::get('theme-store.endpoints.web.middleware', ['web', 'theme-store-public']))
    ->group(function () {
        Route::get('', [StoreController::class, 'index'])->name('index');
        Route::get('search/{keyword}', [StoreController::class, 'search'])->name('search');

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('', [CategoryController::class, 'index'])->name('index');
            Route::get('{category}', [CategoryController::class, 'show'])->name('show');
        });
    });
