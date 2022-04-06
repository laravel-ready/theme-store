<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Web\StoreController as WebStoreController;

Route::name('theme-store.web.')->prefix(Config::get('theme-store.endpoints.web.prefix', 'theme-store'))
    ->middleware(Config::get('theme-store.endpoints.web.middleware', ['web', 'theme-store-public']))
    ->group(function () {
        Route::get('', [WebStoreController::class, 'index'])->name('index');
        Route::get('search/{keyword}', [WebStoreController::class, 'search'])->name('search');
    });
