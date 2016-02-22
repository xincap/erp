<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;
use XinGroup\Model\User;

class UserToken extends Model
{
    protected $table    = 'user_token';
    
    protected $casts = [
      'is_open' => 'boolen'  
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
