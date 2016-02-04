<?php

namespace XinGroup\Http\Controllers\Admin;

use XinGroup\Http\Controllers\Admin\AdminController;
use Request;
use XinGroup\Model\Flow;

class FlowController extends AdminController
{
    public function getDesign(){
        $id     = Request::get('id');
        $obj    = Flow::findOrNew($id);
        return view('admin.flow.design',['obj'=>$obj]);
    }
    
    public function postDesign(){
        $id     = Request::get('id');
        $options    = ['id'=>$id];
        $data       = Request::all();
        $data['flow_type']  = 1;
        $obj    = Flow::updateOrCreate($options, $data, $options);
        return redirect('/admin/flow/design?id='.$obj->id);
    }
}
