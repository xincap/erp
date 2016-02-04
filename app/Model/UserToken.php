<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    protected $table    = 'user_token';
    
    public function user(){
        return $this->belongsTo('XinGroup\Model\User');
    }
}
