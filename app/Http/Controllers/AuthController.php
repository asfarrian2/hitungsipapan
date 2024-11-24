<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_proses(Request $request){
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'Email / Password Salah']);
        }
    }

    public function proseslogout()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    public function login_operator(Request $request){
        if (Auth::guard('uppd')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/operator/dashboard');
        } else {
            return redirect('/auth')->with(['warning' => 'Email / Password Salah']);
        }
    }

    public function logout_operator()
    {
        if (Auth::guard('uppd')->check()) {
            Auth::guard('uppd')->logout();
            return redirect('/auth');
        }
    }

    public function proses_login_wp(Request $request){
        if (Auth::guard('wp')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/wp/home');
        } else {
            return redirect('/auth_wp')->with(['warning' => 'Email / Password Salah']);
        }
    }

    public function logout_wp()
    {
        if (Auth::guard('wp')->check()) {
            Auth::guard('wp')->logout();
            return redirect('/');
        }
    }

}
