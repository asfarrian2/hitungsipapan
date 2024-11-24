<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function dashboard_operator()
    {
        return view('operator.dashboard');
    }

    public function home()
    {
        return view('home');
    }

}
