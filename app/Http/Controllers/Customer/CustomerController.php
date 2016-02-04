<?php

namespace XinGroup\Http\Controllers\Customer;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class CustomerController extends Controller {

    use AuthorizesRequests,DispatchesJobs,ValidatesRequests;

    public function __construct() {
        $this->middleware('auth:customer',['except'=>['weibo','getLogout','getLogin']]);
    }

}
