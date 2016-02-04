<?php

namespace XinGroup\Http\Controllers\Admin;

use XinGroup\Http\Controllers\Admin\AdminController;
use Request;
use XinGroup\Model\Flow;
use XinGroup\Model\FlowProcess;
use XinGroup\Model\Form;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

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
        $data['flow_type']  = 0;
        $obj    = Flow::updateOrCreate($options, $data, $options);
        return redirect('/admin/flow/design?id='.$obj->id);
    }
    
    public function getDraw(){
        $id     = Request::get('id');
        try {
            $one    = Flow::findOrFail($id);
        } catch (ModelNotFoundException $exc) {
            return redirect('/admin/flow/design');
        }
        
        $list   = $one->processes;

        $process_data = array();
        $process_total = 0;
        foreach($list as $value)
        {
            $process_total +=1;
            $style = $value['style'];
            $process_data[] = array(
                'id'=>$value['id'],
                'flow_id'=>$value['flow_id'], 
                'process_name'=>$value['process_name'],
                'process_to'=>$value['process_to'],
                'icon'=>$style['icon'],//图标
                'style'=>'width:'.$style['width'].'px;height:'.$style['height'].'px;line-height:'.$style['height'].'px;color:'.$style['color'].';left:'.$value['setleft'].'px;top:'.$value['settop'].'px;',
            );
        }
        $data   = ['one'=>$one,'process_data'=>  json_encode(['total'=>$process_total,'list'=>$process_data])];
        return view('admin.flow.draw',$data);
    }
    
    public function postProcess() {
        $id = Request::get('flow_id');
        try {
            $one = Flow::findOrFail($id);
        } catch (ModelNotFoundException $exc) {
            return response()->json([
                'status' => 0,
                'msg' => '添加失败,未找到流程',
                'info' => ''
            ]);
        }
        $total   = count($one->processes);
        $process_type = 'is_step';
        if(!$total){
            $process_type   = 'is_one';
        }

        $data = array(
           'flow_id'=>$id, 
           'process_type'=>$process_type,
           'process_name'=>'新建步骤',
           'setleft'=>Request::get('setleft'),
           'settop'=>Request::get('settop'),
           'process_to'=>'',
           'style'=>[
                'icon'=>'icon-star',//图标
                'width'=>'120',
                'height'=>'30',
                'color'=>'#0e76a8',
           ],
           //默认值 
           'child_after'=>1,//子流程结束后动作  默认 1 同时结束父流程    2返回父流程步骤
           'auto_unlock'=>1,//权限：允许更改
        );
        $process    = FlowProcess::forceCreate($data);
        $return     = [
            'status'=>1,
            'msg'=>'success',
            'info'=>array(
                'id'=>$process->id,
                'flow_id'=>$id, 
                'process_name'=>'新建步骤'.$total+1,
                'process_to'=>'',
                'icon'=>'',//图标
                'style'=>'left:'.Request::get('setleft').'px;top:'.Request::get('setop').'px;color:#0e76a8;'//样式 
            ),
        ];
        return response()->json($return);
    }

    public function getAttribute(){
        $process_id = Request::get('id',null);
        $op         = Request::get('op','basic');
        try {
            $process = FlowProcess::findOrFail($process_id);
        } catch (ModelNotFoundException $exc) {
            return response('未找到步骤信息');
        }
        $flow   = $process->flow;
        if($flow->flow_type == 1){
            return response('自由流程不用设置步骤');
        }
        try {
            $form = Form::findOrFail($flow->form_id);
        } catch (ModelNotFoundException $exc) {
            return response('未找到表单信息');
        }
        
        //转出条件 但没 process_to
        if($op=='judge' && !$process['process_to'])
        {
            return response('请先设置属性 -> 选择下一步步骤');
        }
        $process['out_condition'] = $process->getOutCondition($form);//json
        
        $map = array(
            'flow_id'=>$flow->id,//流程ID
            //'id'=>array('neq',$one['id']),//不用排除当前步骤ID    子流程结束后 返回步骤  要用
        );
        $process_list = DB::table('flow_process')->where($map)->get(explode(',', 'id,process_name,process_type'));
        
        $flow_list = DB::table('flow')->get(explode(',', 'id,flow_name'));
        $data   = [
            'op'    => $op,
            'one'   => $process->toArray(),
            'form_one'=> $form->toArray(),
            'form_plugin'=> config('design.flow'),
            'process_to_list'=> $process_list,
            'child_flow_list'=> $flow_list
        ];
        return view('admin.flow.attribute',$data);
    }
   
}
