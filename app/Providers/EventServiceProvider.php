<?php

namespace XinGroup\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Event;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Illuminate\Database\Events\QueryExecuted::class    => [
            \XinGroup\Listeners\Database\LogSql::class
        ],
        \Illuminate\Database\Events\TransactionRolledBack::class    => [
            \XinGroup\Listeners\Database\RolledBack::class
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Weibo\WeiboExtendSocialite::class,
        ],
        \Illuminate\Auth\Events\Login::class => [
            \XinGroup\Listeners\User\Login::class,
        ],
        \Illuminate\Auth\Events\Logout::class => [
            \XinGroup\Listeners\User\Logout::class,
        ],
        \XinGroup\Events\FileUpload::class  => [
            \XinGroup\Listeners\SyncToQiniu::class,
        ]
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events) {
        parent::boot($events);
    }

}
