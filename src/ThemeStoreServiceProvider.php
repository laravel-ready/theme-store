<?php

namespace LaravelReady\ThemeStore;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Services\ThemeStore;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use LaravelReady\ThemeStore\Http\Middleware\PublicStoreMiddleware;

final class ThemeStoreServiceProvider extends BaseServiceProvider
{
    public function boot(Router $router): void
    {
        $this->bootPublishes();

        $this->loadMiddlewares($router);

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


        $assetPath = Config::get('theme-store.assets_path', 'assets/store');

        $this->publishes([
            __DIR__ . '/../resources/public/' => public_path($assetPath)
        ], 'theme-store-assets');


        $this->publishes([
            __DIR__ . '/../resources/views/' => base_path('resources/views/vendor/theme-store')
        ], 'theme-store-views');
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

    /**
     * Load ThemeManagerMiddleware
     *
     * @param Router $router
     */
    private function loadMiddlewares(Router $router): void
    {
        $router->aliasMiddleware('theme-store-public', PublicStoreMiddleware::class);
    }
}
