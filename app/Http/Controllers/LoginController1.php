<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
class LoginController extends Controller
{
    public function getLogin() {
        return view('gv.login');
    }

    public function postLogin() {
        $login = [
            'username' => Input::get('username'),
            'password' => Input::get('password')
        ];
        if (Auth::attempt($login)){
            return redirect()->route('gv.getLophocphan');
        }
        else
        {
            return redirect()->back();
        }
    }
}
