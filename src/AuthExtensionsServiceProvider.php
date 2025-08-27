<?php

namespace CoreKit\AuthExtensions;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use CoreKit\AuthExtensions\Http\Middleware\CheckAuthExtensionsKey;
use Illuminate\Routing\Router;

class AuthExtensionsServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(CheckAuthExtensionsKey::class);


        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
