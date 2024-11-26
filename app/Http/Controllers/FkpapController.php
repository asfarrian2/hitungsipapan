<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class FkpapController extends Controller
{
    public function view(){

        $fkpap = DB::table('fkpap')
        ->orderBy('kegiatan_fkpap', 'ASC')
        ->get();
        return view('fkpap.view', compact('fkpap'));

    }

    public function store(Request $request){

        $kegiatan_fkpap       = $request->i1;
        $pengguna_fkpap       = $request->i2;
        $fkpa                = $request->i3;

        $data=[
            'kegiatan_fkpap'     => $kegiatan_fkpap,
            'pengguna_fkpap'     => $pengguna_fkpap,
            'fkpa'              => $fkpa
        ];

        $insert=DB::table('fkpap')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function update(Request $request){

        $id_fkpap           = $request->i0;
        $kegiatan_fkpap     = $request->i1;
        $pengguna_fkpap     = $request->i2;
        $fkpa               = $request->i3;

        $data =  [
            'kegiatan_fkpap'        => $kegiatan_fkpap,
            'pengguna_fkpap'        => $pengguna_fkpap,
            'fkpa'                  => $fkpa
            ];

            $update = DB::table('fkpap')->where('id_fkpap', $id_fkpap)->update($data);
            if ($update){
                return Redirect('/fkpap/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function edit($id_fkpap){
        $fkpap = DB::table('fkpap')
        ->where('id_fkpap', $id_fkpap)
        ->first();
        return view('fkpap.edit', compact('fkpap'));

    }

    public function hapus($id_fkpap){
        $delete = DB::table('fkpap')
        ->where('id_fkpap', $id_fkpap)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}


