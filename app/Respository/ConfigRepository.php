<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XinGroup\Respository;

use XinGroup\Model\Config;
use Cache;

class ConfigRepository extends RepositoryImpl {
    
    function __construct(Config $model) {
        $this->model    = $model;
    }
    
    public function getValue($key, $default=null, $group='default'){
        
        $data   = Cache::get($group . '_' . $key, null);
        
        if($data){
            return $data;
        }
        
        $query    = $this->model->newQuery();
        $obj    = $query->where(['group_name'=>$group,'name'=>$key])->first();
        
        if($obj){
            $this->setValue($key, $obj->svalue, $group);
        }
        return $obj->svalue ? : $default;
    }
    
    public function setValue($key, $value, $group='default'){
        Cache::put($group . '_' . $key, $value);
    }
    
}
