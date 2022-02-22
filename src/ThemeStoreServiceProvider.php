<?php

namespace LaravelReady\ThemeStore;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

use LaravelReady\ThemeStore\Services\ThemeStore;

final class ThemeStoreServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->bootPublishes();

        $this->loadRoutes();

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'theme-store');
    }

    public function register(): void
    {
        $this->registerConfigs();

        // register theme store service
        $this->app->singleton('theme-store', function () {
            return new ThemeStore();
        });
    }

    /**
     * Boot publishes
     */
    private function bootPublishes(): void
    {
        $this->publishes([
            __DIR__ . '/../config/theme-store.php' => $this->app->configPath('theme-store.php'),
        ], 'theme-store-config');

        $this->publishes([
            __DIR__ . '/../database/migrations/' => database_path('migrations/laravel-ready/theme-store')
        ], 'theme-store-migrations');
    }

    /**
     * Regsiter pacakge configs
     */
    private function registerConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/theme-store.php', 'theme-store');
    }

    /**
     * Load api, web and panel routes
     */
    private function loadRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/theme-store.php');
    }
}
