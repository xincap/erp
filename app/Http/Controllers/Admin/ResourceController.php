<?php

namespace XinGroup\Http\Controllers\Admin;

use XinGroup\Http\Controllers\Admin\AdminController;
use Schema;
use Request;

class ResourceController extends AdminController
{
    public function getIndex(Request $request){
        return \XinGroup\Plugin\TableList::process($request);
    }
}
