<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use app\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ADLoginController extends Controller
{
    public function getLoginAD() {
        return view('admincp.login');
    }

    public function postLoginAD() {

        $login = [
            'username' => Input::get('username'),
            'password' => '123456',
            'level' => 3
        ];
        if (Auth::attempt($login)){
            return redirect()->route('ad.getDSLop');
        }
        else
        {
            return redirect()->back();
        }
    }
}
