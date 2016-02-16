<?php

namespace XinGroup\Jobs\User;

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

    protected $login;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Login $login) {
        $this->login    = $login;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        
        if (!is_object($this->login->user)) {
            return true;
        }

        if(($login->user instanceof \XinGroup\Model\User)){

        }        
    }

}
