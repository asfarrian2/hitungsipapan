<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class KdsController extends Controller
{
    public function view(){

        $kds = DB::table('kds')
        ->get();
        return view('fnap.kds.view', compact('kds'));

    }

    public function store(Request $request){

        $klasifikasi     = $request->i1;
        $bobot_kds       = $request->i2;

        $data=[
            'klasifikasi'  => $klasifikasi,
            'bobot_kds'    => $bobot_kds
        ];

        $insert=DB::table('kds')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function update(Request $request){

        $id_kds      = $request->i0;
        $klasifikasi  = $request->i1;
        $bobot_kds    = $request->i2;

        $data =  [
            'klasifikasi' => $klasifikasi,
            'bobot_kds'   => $bobot_kds,
            ];

            $update = DB::table('kds')->where('id_kds', $id_kds)->update($data);
            if ($update){
                return Redirect('/kds/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function edit($id_kds){
        $kds = DB::table('kds')
        ->where('id_kds', $id_kds)
        ->first();
        return view('fnap.kds.edit', compact('kds'));

    }

    public function hapus($id_kds){
        $delete = DB::table('kds')
        ->where('id_kds', $id_kds)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}

