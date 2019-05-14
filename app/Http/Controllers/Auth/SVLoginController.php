<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use app\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;



class SVLoginController extends Controller
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

    public function getLoginsv() {
        return view('sv.login');
    }

    public function postLoginsv() {
        $login = [
            'username' => Input::get('username'),
            'password' => '123456',
            'level' => 2
        ];
        if (Auth::attempt($login)){
            return redirect()->route('sv.getIndex');
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
