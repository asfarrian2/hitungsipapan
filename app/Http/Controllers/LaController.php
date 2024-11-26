<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class LaController extends Controller
{
    public function view(){

        $la = DB::table('la')
        ->get();
        return view('fnap.la.view', compact('la'));

    }

    public function store(Request $request){

        $lokasi_la     = $request->i1;
        $bobot_la       = $request->i2;

        $data=[
            'lokasi_la'  => $lokasi_la,
            'bobot_la'    => $bobot_la
        ];

        $insert=DB::table('la')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function update(Request $request){

        $id_la      = $request->i0;
        $lokasi_la  = $request->i1;
        $bobot_la    = $request->i2;

        $data =  [
            'lokasi_la' => $lokasi_la,
            'bobot_la'   => $bobot_la,
            ];

            $update = DB::table('la')->where('id_la', $id_la)->update($data);
            if ($update){
                return Redirect('/la/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function edit($id_la){
        $la = DB::table('la')
        ->where('id_la', $id_la)
        ->first();
        return view('fnap.la.edit', compact('la'));

    }

    public function hapus($id_la){
        $delete = DB::table('la')
        ->where('id_la', $id_la)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }




}

