<?php

namespace XinGroup\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if($guard == 'customer'){
                return redirect('/customer/login');
            }
            if($guard == 'admin'){
                return redirect('/admin/login');
            }
            return redirect('/');
        }

        return $next($request);
    }
}
