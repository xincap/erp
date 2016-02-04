<?php

namespace XinGroup\Http\Controllers\Admin;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class AdminController extends Controller {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct() {
        $this->middleware('auth:admin');
    }
}
