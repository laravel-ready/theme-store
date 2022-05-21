<?php

namespace LaravelReady\ThemeStore;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;

use LaravelReady\ThemeStore\Services\ThemeStore;
use Illuminate\Support\ServiceProvider;
use LaravelReady\ThemeStore\Http\Middleware\PublicStoreMiddleware;

final class ThemeStoreServiceProvider extends ServiceProvider
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

        $this->registerDisks();

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
        // package configs
        $this->publishes([
            __DIR__ . '/../config/theme-store.php' => $this->app->configPath('theme-store.php'),
        ], 'theme-store-config');

        // migrations
        $migrationsPath = __DIR__ . '/../database/migrations/';

        $this->publishes([
            $migrationsPath => database_path('migrations/laravel-ready/theme-store')
        ], 'theme-store-migrations');

        $this->loadMigrationsFrom($migrationsPath);

        // assets
        $assetPath = Config::get('theme-store.assets_path', 'assets/store');

        $this->publishes([
            __DIR__ . '/../resources/public/' => public_path($assetPath)
        ], 'theme-store-assets');

        // views
        $this->publishes([
            __DIR__ . '/../resources/views/' => base_path('resources/views/vendor/theme-store')
        ], 'theme-store-views');
    }

    /**
     * Register package configs
     */
    private function registerConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/theme-store.php', 'theme-store');
    }

    /**
     * Add package specific disks for file upload
     */
    private function registerDisks()
    {
        // public disk
        Config::set("filesystems.disks.theme_store_public", [
            'driver' => 'local',
            'root' => storage_path('app/public/theme-store'),
            'url' => request()->getSchemeAndHttpHost() . '/storage/theme-store',
            'visibility' => 'public',
        ]);

        // private disk
        Config::set("filesystems.disks.theme_store_private", [
            'driver' => 'local',
            'root' => storage_path('app/theme-store'),
            'visibility' => 'private',
        ]);
    }

    /**
     * Load api, web and panel routes
     */
    private function loadRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api-private.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api-public.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/panel.php');
    }

    /**
     * Load custom middlewares
     *
     * @param Router $router
     */
    private function loadMiddlewares(Router $router): void
    {
        $router->aliasMiddleware('theme-store-public', PublicStoreMiddleware::class);
    }
}
