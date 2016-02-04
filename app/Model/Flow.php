<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    protected $table    = 'flow';
    
    protected $fillable = [
      'flow_type','form_id','flow_name','flow_desc'  
    ];
    
    public function processes(){
        return $this->hasMany('XinGroup\Model\FlowProcess', 'flow_id', 'id');
    }
}
