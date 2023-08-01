<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    public function login()
    {
        return view('auth.login');
    }

    public function storeLogin(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('home');
        }
        else{
            return back()->with('error', 'Tài khoản hoặc mật khẩu sai');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
