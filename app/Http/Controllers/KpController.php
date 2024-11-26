<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class KpController extends Controller
{
    public function view(){

        $kp = DB::table('kp')
        ->get();
        return view('fnap.kp.view', compact('kp'));

    }

    public function store(Request $request){

        $klasifikasi_kp     = $request->i1;
        $bobot_kp       = $request->i2;

        $data=[
            'klasifikasi_kp'  => $klasifikasi_kp,
            'bobot_kp'    => $bobot_kp
        ];

        $insert=DB::table('kp')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function update(Request $request){

        $id_kp      = $request->i0;
        $klasifikasi_kp  = $request->i1;
        $bobot_kp    = $request->i2;

        $data =  [
            'klasifikasi_kp' => $klasifikasi_kp,
            'bobot_kp'   => $bobot_kp,
            ];

            $update = DB::table('kp')->where('id_kp', $id_kp)->update($data);
            if ($update){
                return Redirect('/kp/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function edit($id_kp){
        $kp = DB::table('kp')
        ->where('id_kp', $id_kp)
        ->first();
        return view('fnap.kp.edit', compact('kp'));

    }

    public function hapus($id_kp){
        $delete = DB::table('kp')
        ->where('id_kp', $id_kp)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}

