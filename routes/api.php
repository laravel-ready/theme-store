<?php

use App\Http\Middleware\VerifyCsrfToken;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Api\Auth\AuthController;

use LaravelReady\ThemeStore\Http\Controllers\Api\Private\Category\CategoryController;
use LaravelReady\ThemeStore\Http\Controllers\Api\Private\Theme\ThemeController;
use LaravelReady\ThemeStore\Http\Controllers\Api\Private\Author\AuthorController;

Route::name('theme-store.api.')
    ->prefix(Config::get('theme-store.endpoints.api.prefix', 'api/theme-store'))
    ->group(function () {
        // public routes for web ui
        Route::name('public.')
            ->prefix('v1')
            ->middleware(Config::get('theme-store.endpoints.api.public_middleware', ['api']))
            ->group(function () {
                Route::name('auth.')->prefix('auth')
                    ->withoutMiddleware([VerifyCsrfToken::class])
                    ->group(function () {
                        Route::post('login', [AuthController::class, 'login'])->name('login');
                    });
            });

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

                // author routes
                Route::prefix('authors')->name('author.')->group(function () {
                    Route::resource('', AuthorController::class)->parameters(['' => 'author']);
                    Route::post('{author}/upload', [AuthorController::class, 'upload'])->name('upload');
                });

                // theme routes
                Route::prefix('themes')->name('theme.')->group(function () {
                    Route::resource('', ThemeController::class)->parameters(['' => 'theme']);
                    Route::post('{theme}/upload', [ThemeController::class, 'upload'])->name('upload');
                });

                // category routes
                Route::prefix('categories')->name('category.')->group(function () {
                    Route::resource('', CategoryController::class)->parameters(['' => 'category']);
                    Route::post('{category}/upload', [CategoryController::class, 'upload'])->name('upload');
                });
            });
    });
