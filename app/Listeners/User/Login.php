<?php

namespace XinGroup\Listeners\User;

use Illuminate\Auth\Events\Login;
use XinGroup\Model\UserLoginLog;
use Log;

class Login {

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
        
        if(($login->user instanceof \XinGroup\Model\User)){
            $login->user->loginIp   = $_SERVER['REMOTE_ADDR'];
            $job  = (new \XinGroup\Jobs\User\Login($login))->onQueue('user');
            $ret    = dispatch($job);
        }
    }

}
