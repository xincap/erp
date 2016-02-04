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
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Weibo\WeiboExtendSocialite::class,
        ],
        \Illuminate\Auth\Events\Login::class => [
            \XinGroup\Listeners\UserLogin::class,
            \XinGroup\Jobs\UserLogin::class,
        ],
        \Illuminate\Auth\Events\Logout::class => [
            \XinGroup\Listeners\UserLogout::class,
            \XinGroup\Jobs\UserLogout::class,
        ],
        'jd.province' => [
            \XinGroup\Jobs\Province::class,
        ],
        'jd.city' => [
            \XinGroup\Jobs\City::class,
        ],
        'jd.county' => [
            \XinGroup\Jobs\County::class,
        ],
        'jd.town' => [
            \XinGroup\Jobs\Town::class,
        ],
        'sms.sent' => [
            \XinGroup\Jobs\AliDaYu::class,
        ],
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
