<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class KaController extends Controller
{
    public function view(){

        $ka = DB::table('ka')
        ->get();
        return view('fnap.ka.view', compact('ka'));

    }

    public function store(Request $request){

        $kualitas_air     = $request->i1;
        $bobot_ka       = $request->i2;

        $data=[
            'kualitas_air'  => $kualitas_air,
            'bobot_ka'    => $bobot_ka
        ];

        $insert=DB::table('ka')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function update(Request $request){

        $id_ka      = $request->i0;
        $kualitas_air  = $request->i1;
        $bobot_ka    = $request->i2;

        $data =  [
            'kualitas_air' => $kualitas_air,
            'bobot_ka'   => $bobot_ka,
            ];

            $update = DB::table('ka')->where('id_ka', $id_ka)->update($data);
            if ($update){
                return Redirect('/ka/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function edit($id_ka){
        $ka = DB::table('ka')
        ->where('id_ka', $id_ka)
        ->first();
        return view('fnap.ka.edit', compact('ka'));

    }

    public function hapus($id_ka){
        $delete = DB::table('ka')
        ->where('id_ka', $id_ka)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}
