<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

class FlowProcess extends Model
{
    protected $table    = 'flow_process';

    public function flow(){
        return $this->belongsTo('XinGroup\Model\Flow', 'flow_id','id');
    }
    
    public function form(){
        return $this->belongsTo('XinGroup\Model\Flow', 'form_id','id');
    }
    
    public function setStyleAttribute($style){
        $this->attributes['style']    = json_encode($style,JSON_UNESCAPED_UNICODE);
    }
    
    public function getStyleAttribute($style){
        return json_decode($style,true);
    }
    
    public function setWriteFieldsAttribute($value){
        $this->attributes['write_fields']   = implode(',', $value);
    }
    
    public function getWriteFieldsAttribute($value){
        return explode(',', $value);
    }
    
    public function setSecretFieldsAttribute($value){
        $this->attributes['secret_fields']   = implode(',', $value);
    }
    
    public function getSecretFieldsAttribute($value){
        return explode(',', $value);
    }
//    public function getChildBackProcessAttribute($value){
//        return explode(',', $value);
//    }
    
    public function setLockFieldsAttribute($value){
        $this->attributes['lock_fields']   = implode(',', $value);
    }
    
    public function getLockFieldsAttribute($value){
        return explode(',', $value);
    }
    
    public function setOutConditionAttribute($value){
        $this->attributes['out_condition']   = json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    
    public function getOutConditionAttribute($value){
        return json_decode($value,true);
    }
    
    public function getOutCondition(Form $form){
        return $this->parseOutCondition($this->out_condition, $form->content_data);
    }
    
    protected function parseOutCondition($json_data,$field_data)
    {
        $array = json_decode($json_data,true);
        if(!$array)
        {
            return '[]';
        }
        
        $json_data = array();//重置
        foreach($array as $key=>$value)
        {
            $condition = '';
            foreach($value['condition'] as $val)
            {
                //匹配 $field_data 
                //把data_x 替换回 中文名称
                $preg =  "/'(data_[0-9]?|checkboxs_[0-9]?)'/s";
                preg_match_all($preg,$val,$temparr);
                $val_text = '';
                foreach($temparr[0] as $k=>$v)
                {
                    $field_name = self::getFieldName($temparr[1][$k],$field_data);
                    if($field_name)
                        $val_text = str_replace($v,"'".$field_name."'",$val);
                    else
                        $val_text = $val;
                }
                
                $condition.='<option value="'.$val.'">'.$val_text.'</option>';
            }
            
            $value['condition'] = $condition;
            $json_data[$key] = $value;
        }
        
        return json_encode($json_data,JSON_UNESCAPED_UNICODE);
        
        /*
        $flow_id  = intval($_POST['flow_id']);
        $process_id  = intval($_POST['process_id']);
        
        $arr = array(
            //步骤ID => desc 不符合条件时的提示   option 显示文本   value 值 
            '59'=>array(
                'condition_desc'=>'不符合条件时的提示',
                'condition'=>"<option value=\"'data_1' = '33'  AND\">'爱好' = '33' AND</option><option value=\"'data_2' = '44'\">'姓名' = '44'</option>"
            ),
        );
        echo json_encode($arr);
        */
    }
    
    protected function getFieldName($field,$field_data)
    {
        $field = trim($field);
        if(!$field) return '';
        $title = '';
        foreach($field_data as $value)
        {
            if($value['leipiplugins'] =='checkboxs' && $value['parse_name']==$field)
            {
                $title = $value['title'];
                break;
            }else if($value['name']==$field)
            {
                $title = $value['title'];
                break;
            }
        }
        return $title;
    }

}
