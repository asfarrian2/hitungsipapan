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
            return redirect('/');
        }
    }

    // public function login_operator(Request $request){
    //     if (Auth::guard('uppd')->attempt(['email' => $request->email, 'password' => $request->password])) {
    //         return redirect('/admin/dashboard');
    //     } else {
    //         return redirect('/')->with(['warning' => 'ID / Password Salah']);
    //     }
    // }

}
