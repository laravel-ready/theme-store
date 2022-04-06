<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Panel\PanelController;

Route::name('theme-store.panel.')
    ->prefix(Config::get('theme-store.endpoints.panel.prefix', 'theme-store/panel'))
    ->middleware(Config::get('theme-store.endpoints.panel.middleware', ['web', 'auth']))
    ->group(function () {
        Route::get('', [PanelController::class, 'index']);
    });;
