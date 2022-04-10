<?php

namespace LaravelReady\ThemeStore\Traits;

use Illuminate\Support\Facades\Config;

trait StoreCacheTrait
{
    protected $section = 'store';

    /**
     * Get the cache key for the given request.
     *
     * @param  string  $key
     * @return string
     */
    protected function getCacheKey($key)
    {
        return "theme-store.{$this->section}.{$key}";
    }

    /**
     * Get the cache lifetime for the given request.
     *
     * @return int
     */
    protected function getCacheLifetime()
    {
        return Config::get('theme-store.cache.web.lifetime', 60);
    }
}
