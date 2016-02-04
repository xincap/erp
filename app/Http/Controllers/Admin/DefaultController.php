<?php

namespace XinGroup\Http\Controllers\Admin;

use XinGroup\Http\Controllers\Admin\AdminController;
use Session;

class DefaultController extends AdminController
{
    public function index() {
        return view('home');
    }
}
