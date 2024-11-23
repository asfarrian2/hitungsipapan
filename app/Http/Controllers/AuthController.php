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
            return redirect('/')->with(['warning' => 'ID / Password Salah']);
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
            return redirect('/auth')->with(['warning' => 'ID / Password Salah']);
        }
    }

    public function logout_operator()
    {
        if (Auth::guard('uppd')->check()) {
            Auth::guard('uppd')->logout();
            return redirect('/auth');
        }
    }

}
