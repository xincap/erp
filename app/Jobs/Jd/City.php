<?php

namespace XinGroup\Jobs\Jd;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jd\JdClient;
use Jd\Request\AreasCountyGetRequest;
use Event;
use XinGroup\Model\AddressCity as Model;
use XinGroup\Jobs\Jd\County;

class City extends Job implements ShouldQueue
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
        $obj->name  = $this->data['areaName'];
        $obj->province_id   = $this->data['province_id'];
        $obj->save();
        
        
        $c = new JdClient();
        $c->setAppKey(env('JD_APP_ID'));
        $c->setAppSecret(env('JD_APP_SECRET'));
        
        $req = new AreasCountyGetRequest();
        $req->setParentId($this->data['areaId']);
        $resp   = $c->execute($req);
        if(isset($resp['zh_desc'])){
            Log::error($resp['zh_desc']);
        }
        $data   = $resp['baseAreaServiceResponse']['data'];
        foreach ($data as $key => $item) {
            $item['city_id']    = $obj->id;
            $event  = new County($item);
            Event::fire($event);
        }
    }
}
