<?php

namespace XinGroup\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {

    use EntrustUserTrait;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function token() {
        return $this->hasOne('XinGroup\Model\UserToken', 'user_id', 'id');
    }

    public function loginLogs() {
        return $this->hasMany('XinGroup\Model\UserLoginLog', 'user_id', 'id');
    }

}
