<?php

namespace XinGroup\Jobs;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Jd\JdClient;
use Jd\Request\AreasTownGetRequest;
use Event;
use XinGroup\Model\AddressCounty as Model;
use Log;

class County extends Job implements ShouldQueue
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
        $obj->name  = $data['areaName'];
        $obj->city_id   = $data['city_id'];
        $obj->save();
        
        $c = new JdClient();
        $c->setAppKey(env('JD_APP_ID'));
        $c->setAppSecret(env('JD_APP_SECRET'));
        
        $req = new AreasTownGetRequest();
        $req->setParentId($data['areaId']);
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
            Event::fire('jd.town', [$item]);
        }
    }
}
