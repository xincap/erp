<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    protected $table    = 'flow';
    
    protected $fillable = [
      'flow_type','form_id','flow_name','flow_desc'  
    ];
}
