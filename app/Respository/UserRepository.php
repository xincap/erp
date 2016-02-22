<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace XinGroup\Respository;

use \XinGroup\Model\User;
use Validator;

class UserRepository extends RepositoryImpl {
    
    function __construct(User $model) {
        $this->model    = $model;
    }
    
    public function register($data){
        
    }
    
}
