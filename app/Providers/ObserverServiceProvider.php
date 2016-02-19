<?php

namespace XinGroup\Providers;

use Illuminate\Support\ServiceProvider;

use XinGroup\Model\User;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(new \Observer\Observer\UserObserver());
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
