<?php

namespace XinGroup\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable {

    protected $table = 'customer';
    
    protected $fillable = [
        'name', 'email', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token'
    ];

}
