<?php

namespace XinGroup\Jobs;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use XinGroup\Model\AddressTown as Model;

class Town extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($data)
    {
        $obj    = new Model();
        $obj->county_id = $data['county_id'];
        $obj->name  = $data['areaName'];
        $obj->save();
    }
}
