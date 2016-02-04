<?php

namespace XinGroup\Http\Controllers\Api;

use XinGroup\Http\Requests;
use XinGroup\Http\Controllers\Controller;
use XinGroup\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Request;

class UserController extends Controller {

    public function index() {
        return $this->show();
    }

    public function show() {
        $id = Request::get('user_id');
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $exc) {
            return response(['ret' => 404, 'msg' => 'user not found.']);
        }
        
        return response(['ret'=>200,'data'=>$user->toArray()]);
    }

}
