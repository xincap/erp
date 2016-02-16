<?php

namespace XinGroup\Listeners\User;

use Illuminate\Auth\Events\Logout;
use Event;
use Log;

class Logout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
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

        }
    }
}
