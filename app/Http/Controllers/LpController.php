<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class LpController extends Controller
{
    public function view(){

        $lp = DB::table('lp')
        ->get();
        return view('fnap.lp.view', compact('lp'));

    }

    public function store(Request $request){

        $lokasi_lp     = $request->i1;
        $bobot_lp       = $request->i2;

        $data=[
            'lokasi_lp'  => $lokasi_lp,
            'bobot_lp'    => $bobot_lp
        ];

        $insert=DB::table('lp')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function update(Request $request){

        $id_lp      = $request->i0;
        $lokasi_lp  = $request->i1;
        $bobot_lp    = $request->i2;

        $data =  [
            'lokasi_lp' => $lokasi_lp,
            'bobot_lp'   => $bobot_lp,
            ];

            $update = DB::table('lp')->where('id_lp', $id_lp)->update($data);
            if ($update){
                return Redirect('/lp/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function edit($id_lp){
        $lp = DB::table('lp')
        ->where('id_lp', $id_lp)
        ->first();
        return view('fnap.lp.edit', compact('lp'));

    }

    public function hapus($id_lp){
        $delete = DB::table('lp')
        ->where('id_lp', $id_lp)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

}


