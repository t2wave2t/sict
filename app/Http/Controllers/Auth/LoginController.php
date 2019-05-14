<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use app\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function getLogin() {
        return view('gv.login');
    }

    public function postLogin() {
        $login = [
            'username' => Input::get('username'),
            'password' => Input::get('password'),
            'level' => 1
        ];
        if (Auth::attempt($login)){
            return redirect()->route('gv.getLophocphan');
        }
        else
        {
            return redirect()->back();
        }
    }


   /* use AuthenticatesUsers;


    protected $redirectTo = '/home';


    public function username()
    {
        return 'username';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }*/
}
