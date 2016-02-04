<?php

namespace XinGroup\Model;

use Illuminate\Database\Eloquent\Model;

class UserLoginLog extends Model
{
    protected $table    = 'user_login_log';
    
    protected $fillable = [
        'user_id', 'updated_at','ip',
    ];
}
