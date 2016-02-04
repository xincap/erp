<?php

namespace XinGroup\Jobs;

use XinGroup\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Jd\JdClient;
use Jd\Request\AreasCityGetRequest;
use Event;
use XinGroup\Model\AddressProvince as Model;

class Province extends Job implements ShouldQueue
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
        $obj->save();
        
        
        $c = new JdClient();
        $c->setAppKey(env('JD_APP_ID'));
        $c->setAppSecret(env('JD_APP_SECRET'));
        
        $req = new AreasCityGetRequest();
        $req->setParentId($data['areaId']);
        $resp   = $c->execute($req);
        $data   = $resp['baseAreaServiceResponse']['data'];
        
        foreach ($data as $key => $item) {
            $item['province_id']    = $obj->id;
            Event::fire('jd.city', [$item]);
        }
    }
}
