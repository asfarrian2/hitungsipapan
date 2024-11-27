<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $id_wajibpajak = Auth::guard('wp')->user()->id_wajibpajak;
        $objek_pajak=DB::table('objek_pajak')
        ->where('id_wajibpajak',$id_wajibpajak)
        ->get();

        return view('home', compact('objek_pajak'));
    }

}
