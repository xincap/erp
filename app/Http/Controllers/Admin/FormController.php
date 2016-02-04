<?php

namespace XinGroup\Http\Controllers\Admin;

use XinGroup\Http\Controllers\Admin\AdminController;
use Request;
use XinGroup\Plugin\FormDesign;
use XinGroup\Model\Form;
use XinGroup\Model\FormData;
use DB;
use Schema;

class FormController extends AdminController
{
    public function getDesign(){
        
        $id = Request::get('id',null);
        $obj    = Form::findOrNew($id);
        return view('admin.form.design',['obj'=>$obj]);
    }
    
    public function postDesign(){
        
        $id = Request::get('form_id',null);
        
        try {
            $obj   = Form::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exc) {
            return response('not found');
        }
        
        $form       = new FormDesign();
        $content    = Request::get('design_content');
        $resp       = $form->parse_form($content);
        $sql        = $form->parse_table($obj->id, $resp['add_fields']);
        $data = array(
            'fields'=>$resp['fields'],
            'content'=>$resp['template'],
            'content_parse'=>$resp['parse'],
            'content_data'=>  json_encode($resp['data'],JSON_UNESCAPED_UNICODE),
        );
        $ret    = $obj->update($data,['id'=>$id]);
        return redirect('/admin/form/design?id='.$id);
    }
    
    public function getPreview(){
        $id         = Request::get('id',null);
        $obj        = Form::findOrNew($id);
        $form       = new FormDesign();
        $content    = $form->unparse_form($obj, [],['action'=>'preview']);
        return view('admin.form.preview',['obj'=>$obj,'text'=>$content]);
    }
    
    public function getSubmit(){
        $id         = Request::get('id',null);
        try {
            $obj   = Form::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exc) {
            return response('not found');
        }
        $form       = new FormDesign();
        $content    = $form->unparse_form($obj, [],['action'=>'preview']);
        return view('admin.form.submit',['obj'=>$obj,'text'=>$content]);
    }
    
    public function postSubmit(){
        
        $id     = Request::get('form_id');
        
        try {
            $obj   = Form::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exc) {
            return response('not found');
        }
        $conn = Schema::getConnection();
        $manager   = $conn->getDoctrineSchemaManager();
        $data   = new FormData();
        $data->setTable($id);
        
        $list   = $manager->listTableColumns($conn->getTablePrefix(). $data->getTable());

        $all    = Request::all();
        foreach ($list as $k => $v){
            if(!strstr($k, 'form_') && !strstr($k, 'data_')){
                continue;
            }
            if(array_key_exists($k, $all)){
                $data->$k = $all[$k];
            }
        }
        $ret    = $data->save();
        return redirect('/admin/form/submit?id='.$id);
    }
}