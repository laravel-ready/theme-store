<?php

namespace LaravelReady\ThemeStore\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PublicStoreMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $publicAccess = Config::get('theme-store.public_store.allow_access', false);

        if ($publicAccess) {
            return $next($request);
        }

        $abortStatusCode = Config::get('theme-store.public_store.abort_status_code', 404);

        return abort($abortStatusCode);
    }
}
