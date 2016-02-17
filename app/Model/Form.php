<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

class Form extends Model {

    protected $table = 'form';
    
//    protected $cast = [
//        'content_data'  => 'json'
//    ];
    
    protected $fillable = [
      'fields','content','content_parse','content_data'
    ];
    
    
    public function setContentDataAttribute($value){
        $this->attributes['content_data']   = json_encode($value,JSON_UNESCAPED_UNICODE);
    }
    
    public function getContentDataAttribute($value){
        $value  =  json_decode($value, true);
        if(!is_array($value)){
            return \Qiniu\json_decode($value, true);
        }
        return $value;
    }
}
