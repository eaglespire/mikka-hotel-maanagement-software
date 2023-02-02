<?php

namespace App\Providers;

use App\Models\Setting;
use App\Services\CacheKeys;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!empty( env('NGROK_URL') ) && request()->server->has('HTTP_X_ORIGINAL_HOST')) {
            $this->app['url']->forceRootUrl(env('NGROK_URL'));
        }
        //ngrok http -host-header=rewrite laravel-site.test:80
        //run the abov command on the terminal

        /*
         * You’ll get a forwarding URL back. This URL, typically looking something like abc123.ngrok.io.

            In your .env file, specify the property NGROK_URL with the URL you have received from ngrok.

            You might need to empty your app’s cache (from the terminal):

            php artisan config:clear
            php artisan cache:clear
            php artisan view:clear
            php artisan route:clear
         */
        Paginator::useBootstrap();

        $settings = Cache::remember(CacheKeys::SETTING_CACHE, now()->addDays(30), function (){
            return Setting::first();
        });
        view()->share('settings',$settings);
    }
}
