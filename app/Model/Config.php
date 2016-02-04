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
    
    
    public function getSvalueAttribute(){
        return $this->svalue;
    }
    
    public function setSvalueAttribute($value){
        $this->svalue   = $value;
    }
}
