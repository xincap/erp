<?php

namespace XinGroup\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Log;
use Illuminate\Database\Events\QueryExecuted;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $version = config('app.version');
        view()->share('version', $version);
        DB::enableQueryLog();
//    $this->app->resolving(function ($object, $app) {
//        // 容器解析所有类型对象时调用
//    });
//
//    $this->app->resolving(function (FooBar $fooBar, $app) {
//        // 容器解析“FooBar”对象时调用
//    });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        
    }

}
