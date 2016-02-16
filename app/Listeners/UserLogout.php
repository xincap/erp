<?php

namespace XinGroup\Listeners;

use Illuminate\Auth\Events\Logout;
use Event;
use Log;

class UserLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(Logout $logout)
    {
        if(!is_object($logout->user)){
            return true;
        }
        
        if(($logout->user instanceof \XinGroup\Model\User)){
//            $event  = new \XinGroup\Jobs\User\UserLogout($logout);
//            Event::fire($event);
            Log::error('user '. $logout->user->id .' was logout.');
        }
    }
}
