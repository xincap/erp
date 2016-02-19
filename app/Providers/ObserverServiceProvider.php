<?php

namespace XinGroup\Providers;

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //User::observe(new \XinGroup\Observer\UserObserver());
        $this->registerObserve();
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
    
    protected function registerObserve(){
        $files      = glob(app_path('Observer/*Observer.php'));
        $preFix     = '\\XinGroup\Observer\\';
        $modelFix   = '\\XinGroup\Model\\';
        if(count($files)){
            foreach ($files as $key => $file) {
                $name   = pathinfo($file,PATHINFO_FILENAME);
                $class  = $preFix . $name;
                $model  = $modelFix . str_replace('Observer', '', $name);
                $object = new $class();
                $model::observe($object);
            }
        }
    }
}
