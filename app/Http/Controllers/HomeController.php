<?php

namespace XinGroup\Http\Controllers;

use XinGroup\Http\Controllers\Controller;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //$conn   = Schema::getConnection();
        //dd($conn->getDoctrineSchemaManager()->listTableColumns('ue_user'));
        
        return view('home');
    }
}
