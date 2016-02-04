<?php

namespace XinGroup\Http\Controllers\Customer;

use XinGroup\Http\Controllers\Customer\CustomerController;
use Auth;
use Jd\JdClient;
use Jd\Request\AreasProvinceGetRequest;
use Event;
use XinGroup\Events\Province;
use Request;

class DefaultController extends CustomerController {
    
    public function index() {
        return view('customer');
    }
    
    public function oauth() {
        $code   = Request::get('code',null);
        $type   = Request::get('type','weibo');
        if(!$code){
            return \Socialite::with($type)->redirect();
        }
        $oauth = \Socialite::with($type)->user();
        dd($oauth);
        // return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }
}
