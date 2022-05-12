<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Web\StoreController;
use LaravelReady\ThemeStore\Http\Controllers\Web\CategoryController;
use LaravelReady\ThemeStore\Http\Controllers\Web\AuthorController;
use LaravelReady\ThemeStore\Http\Controllers\Web\ThemeController;

Route::name('theme-store.web.')->prefix(Config::get('theme-store.endpoints.web.prefix', 'theme-store'))
    ->middleware(Config::get('theme-store.endpoints.web.middleware', ['web', 'theme-store-public']))
    ->group(function () {
        Route::get('', [StoreController::class, 'index'])->name('index');
        Route::get('search/{q?}', [StoreController::class, 'search'])->name('search');

        Route::prefix('themes')->name('themes.')->group(function () {
            Route::get('', [ThemeController::class, 'index'])->name('index');
            Route::get('{theme_slug}', [ThemeController::class, 'show'])->name('show');
            Route::get('{theme_slug}/download', [ThemeController::class, 'showDownload'])->name('download.show');

            Route::get('download/{token}', [ThemeController::class, 'downloadTheme'])->middleware([
                'throttle:5,1',
            ])->name('download');
        });

        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('', [CategoryController::class, 'index'])->name('index');
            Route::get('{category}', [CategoryController::class, 'show'])->name('show');
        });

        Route::prefix('users')->name('users.')->group(function () {
            Route::get('', [AuthorController::class, 'index'])->name('index');
            Route::get('{user}', [AuthorController::class, 'show'])->name('show');
        });
    });
