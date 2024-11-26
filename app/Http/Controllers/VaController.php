<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class VaController extends Controller
{
    public function view(){

        $va = DB::table('va')
        ->get();
        return view('fnap.va.view', compact('va'));

    }

    public function store(Request $request){

        $volume     = $request->i1;
        $bobot_va       = $request->i2;

        $data=[
            'volume'  => $volume,
            'bobot_va'    => $bobot_va
        ];

        $insert=DB::table('va')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function update(Request $request){

        $id_va      = $request->i0;
        $volume  = $request->i1;
        $bobot_va    = $request->i2;

        $data =  [
            'volume' => $volume,
            'bobot_va'   => $bobot_va,
            ];

            $update = DB::table('va')->where('id_va', $id_va)->update($data);
            if ($update){
                return Redirect('/va/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function edit($id_va){
        $va = DB::table('va')
        ->where('id_va', $id_va)
        ->first();
        return view('fnap.va.edit', compact('va'));

    }

    public function hapus($id_va){
        $delete = DB::table('va')
        ->where('id_va', $id_va)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}
