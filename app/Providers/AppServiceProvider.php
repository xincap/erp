<?php

namespace XinGroup\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $conf   = config('app');
        view()->share('version', $conf['version']);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
