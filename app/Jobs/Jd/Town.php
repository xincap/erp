<?php

namespace XinGroup\Jobs\Jd;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use XinGroup\Model\AddressTown as Model;

class Town extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $obj    = new Model();
        $obj->county_id = $this->data['county_id'];
        $obj->name  = $this->data['areaName'];
        $obj->save();
    }
}
