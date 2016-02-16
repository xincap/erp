<?php

namespace XinGroup\Jobs\Jd;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jd\JdClient;
use Jd\Request\AreasTownGetRequest;
use Event;
use XinGroup\Model\AddressCounty as Model;
use Log;
use XinGroup\Jobs\Jd\Town;

class County extends Job implements ShouldQueue
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
        $this->data    = $data;
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
        $obj->city_id   = $this->data['city_id'];
        $obj->save();
        
        $c = new JdClient();
        $c->setAppKey(env('JD_APP_ID'));
        $c->setAppSecret(env('JD_APP_SECRET'));
        
        $req = new AreasTownGetRequest();
        $req->setParentId($this->data['areaId']);
        $resp   = $c->execute($req);
        if(isset($resp['zh_desc'])){
            Log::error($resp['zh_desc']);
        }
        $data   = $resp['baseAreaServiceResponse']['data'];
        
        if(!$data){
            return true;
        }
        
        foreach ($data as $key => $item) {
            $item['county_id']  = $obj->id;
            $event  = new Town($item);
            Event::fire($event);
        }
    }
}
