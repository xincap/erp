<?php

namespace XinGroup\Http\Controllers\Customer;

use XinGroup\Model\Customer;
use Validator;
use XinGroup\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/customer';
    protected $redirectAfterLogout = '/customer/login';
    protected $guard = 'customer';
    protected $loginView = 'customer.login';
    protected $registerView = 'customer.register';

    public function __construct() {
        $this->middleware('guest:customer', ['except' => 'logout']);
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:customer',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    protected function create(array $data) {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    protected function authenticated(Request $request, Authenticatable $user){
//        UserLoginLog::create([
//            'user_id'   => $user->id,
//            'ip'        => '127.0.0.1',
//            'updated_at'    => $user->updated_at
//        ]);
        return redirect()->intended($this->redirectPath());
    }
}
