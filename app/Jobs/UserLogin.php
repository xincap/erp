<?php

namespace XinGroup\Jobs;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Events\Login;
use XinGroup\Model\UserLoginLog;
use Request;
use Log;

class UserLogin extends Job implements ShouldQueue {

    use InteractsWithQueue,
        SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Login $login) {
        
        if (!is_object($login->user)) {
            return true;
        }

        if(($login->user instanceof \XinGroup\Model\User)){

        }        
    }

}
