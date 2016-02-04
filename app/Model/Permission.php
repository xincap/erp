<?php

namespace XinGroup\Model;

use Zizaco\Entrust\EntrustPermission;

/**
 * XinGroup\Model\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\XinGroup\Model\Role[] $roles
 */
class Permission extends EntrustPermission {

    protected $table = 'permission';
    
    public $timestamps = false;

}
