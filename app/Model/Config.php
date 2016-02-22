<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * XinGroup\Model\Config
 *
 * @property mixed $svalue
 */
class Config extends Model
{
    protected $name = 'config';
    
    protected $casts    = [
        'svalue'    => 'json'
    ]; 


    public $timestamps  = false;
    
    
    public function getSvalueAttribute($value){
        return json_decode($value);
    }
    
    public function setSvalueAttribute($value){
        $this->attributes['svalue']   = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
