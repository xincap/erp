<?php

namespace XinGroup\Listeners;

use Illuminate\Auth\Events\Login;
use Event;

class UserLogin {

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Events  $event
     * @return void
     */
    public function handle(Login $login) {
        if (!is_object($login->user)) {
            return true;
        }
        
        if(($login->user instanceof XinGroup\Model\User)){
            $event  = new \XinGroup\Jobs\User\UserLogin($login);
            Event::fire($event);
        }
    }

}
