<?php

namespace XinGroup\Http\Controllers;

use Illuminate\Http\Request;
use XinGroup\Http\Requests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Event;

class WelcomeController extends Controller {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $request;

    public function __construct(Request $request) {
        $this->request  = $request;
        $this->middleware('auth:customer',['except'=>['getIndex']]);
    }

    public function getIndex() {
//        $data   = ['code'=> (string)mt_rand(10000, 99999),'product'=>'腾讯科技'];
//        $mobile = '17717556505';
//        Event::fire('sms.send',[$data,$mobile]);
        return view('welcome');
    }

}
