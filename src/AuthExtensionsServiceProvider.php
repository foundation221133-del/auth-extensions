<?php

namespace CoreKit\AuthExtensions;

use Illuminate\Support\ServiceProvider;


class AuthExtensionsServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {

        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
