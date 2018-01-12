<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function postLogin(Request $request)
    {
       $name=$request->get('username');
       $password=$request->get('password');
        $users=User::findByname($name);
        if (!empty($users)){
            if ($users->checkPassword($password)){
                $api_token=$users->login();
                return $this->jsonSuccess([
                    'api_token' => $api_token
                ]);
            }else{
                return $this->jsonResponse(1422, '密码错误');
            }
        }else{
            return $this->jsonResponse(1000,'用户不存在');
        }
     }

    public function logout(AuthManager $auth)
    {
        $admin = $auth->guard('api')->user();
        $username = $admin->name;
        User::where('name', $username)->update([
            'api_token' => null
        ]);

        return $this->jsonSuccess();

     }
}
