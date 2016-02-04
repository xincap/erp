<?php

namespace XinGroup\Http\Controllers\Api;

use XinGroup\Http\Requests;
use XinGroup\Http\Controllers\Controller;
use Request;
use Auth;

class DefaultController extends Controller {
    
    /**
     * @apiVersion 1.0.1
     * @api {get} /api/login 用户登录
     * @apiName UserLogin
     * @apiParam {String} user  登录帐号
     * @apiParam {String} pass  登录密码
     */
    public function index() {
        
        $user = Request::get('user', null);
        $pass = Request::get('pass', null);
        $credentials = ['name' => $user, 'password' => $pass];
        
        $login = Auth::guard()->attempt($credentials);
        if (!$login) {
            return response(['ret' => 404, 'msg' => 'user not found']);
        }
        
        $user = Auth::guard()->user();
        $token = $user->token;
        return response($user->toArray());
    }

}
