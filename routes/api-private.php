<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Http\Controllers\Api\Auth\AuthController;

use LaravelReady\ThemeStore\Http\Controllers\Api\Private\Category\CategoryController;
use LaravelReady\ThemeStore\Http\Controllers\Api\Private\Theme\ThemeController;
use LaravelReady\ThemeStore\Http\Controllers\Api\Private\Author\AuthorController;
use LaravelReady\ThemeStore\Http\Controllers\Api\Private\Theme\Release\ReleaseController;

Route::name('theme-store.api.')
    ->prefix(Config::get('theme-store.endpoints.api.prefix', 'api/theme-store'))
    ->group(function () {
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

                // authors
                Route::prefix('authors')->name('authors.')->group(function () {
                    Route::resource('', AuthorController::class)->parameters(['' => 'author']);
                    Route::post('{author}/upload', [AuthorController::class, 'upload'])->name('upload');
                });

                // themes
                Route::prefix('themes')->name('themes.')->group(function () {
                    // releases
                    Route::prefix('releases')->name('releases.')->group(function () {
                        Route::resource('', ReleaseController::class)->parameters(['' => 'release']);
                        Route::post('{release}/upload', [ReleaseController::class, 'upload'])->name('upload');
                        Route::get('{release}/download', [ReleaseController::class, 'download'])->name('download')
                            ->middleware(
                                ['throttle:20,1']
                            );
                    });

                    // themes
                    Route::resource('', ThemeController::class)->parameters(['' => 'theme']);
                    Route::post('{theme}/upload', [ThemeController::class, 'upload'])->name('upload');
                });

                // categories
                Route::prefix('categories')->name('categories.')->group(function () {
                    Route::resource('', CategoryController::class)->parameters(['' => 'category']);
                    Route::post('{category}/upload', [CategoryController::class, 'upload'])->name('upload');
                });
            });
    });
