<?php

namespace App\Providers;

use App\Models\WebsiteSetting;
use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        try
        {
            $this->app->singleton('website_settings', function(){
                return WebsiteSetting::all()->first();
            });
        }
        catch(Exception $e)
        {

        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try
        {
            $settings = WebsiteSetting::all()->first();
            View::share('website_settings', $settings);
        }
        catch(Exception $e)
        {
            
        }
    }
}
