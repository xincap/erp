<?php

namespace XinGroup\Model;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {

    protected $table = 'role';
    
    public $timestamps = false;

}
