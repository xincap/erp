<?php

namespace XinGroup\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use XinGroup\Model\UserToken;

class Api {

    protected $except = [
        'user/*'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        $token  = $request->get('token', null);

        if(strstr(urldecode($request->url()), 'api/login')){
            return $next($request);
        }
        
        if(!$token){
            return response(['ret'=>403,'msg'=>'access token need.']);
        }
        
        $access = UserToken::where(['token'=>$token])->first();
        
        if(!is_object($access)){
            return response(['ret'=>403,'msg'=>'access token not found.']);
        }
        
        if(!$access->is_open){
            return response(['ret'=>403,'msg'=>'API Is Closed .']);
        }
        
        $request->attributes->set('user_id', $access->user_id);
        
        return $next($request);
    }

}
