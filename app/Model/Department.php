<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * XinGroup\Model\Department
 *
 * @property integer $id
 * @property integer $pid
 * @property string $name
 * @property boolean $sort
 * @property-read \Illuminate\Database\Eloquent\Collection|\XinGroup\Model\Department[] $depts
 */
class Department extends Model {

    protected $table = 'department';
    
    public $timestamps = false;
    
    public function depts(){
        return $this->hasMany('\XinGroup\Model\Department', 'pid', 'id');
    }

}
