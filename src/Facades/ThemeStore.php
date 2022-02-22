<?php

namespace LaravelReady\ThemeStore\Facades;

use Illuminate\Support\Facades\Facade;

class ThemeStore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'theme-store';
    }
}
