<?php

namespace XinGroup\Jobs\User;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Events\Logout;

class Logout extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $logout;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Logout $logout)
    {
        $this->logout   = $logout;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!is_object($this->logout->user)){
            return true;
        }
    }
}
