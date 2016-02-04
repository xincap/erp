<?php

namespace XinGroup\Listeners;

use Illuminate\Auth\Events\Login;

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
        
        if(($login->user instanceof \XinGroup\Model\Customer)){
            
        }
    }

}
