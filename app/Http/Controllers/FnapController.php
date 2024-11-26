<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class FnapController extends Controller
{
    public function view(){

        $sa = DB::table('sa')
        ->get();
        return view('fnap.sa.view', compact('sa'));

    }

    public function store(Request $request){

        $sumber_air     = $request->i1;
        $bobot_sa       = $request->i2;

        $data=[
            'sumber_air'  => $sumber_air,
            'bobot_sa'    => $bobot_sa
        ];

        $insert=DB::table('sa')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function update(Request $request){

        $id_sa      = $request->i0;
        $sumber_air  = $request->i1;
        $bobot_sa    = $request->i2;

        $data =  [
            'sumber_air' => $sumber_air,
            'bobot_sa'   => $bobot_sa,
            ];

            $update = DB::table('sa')->where('id_sa', $id_sa)->update($data);
            if ($update){
                return Redirect('/sa/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function edit($id_sa){
        $sa = DB::table('sa')
        ->where('id_sa', $id_sa)
        ->first();
        return view('fnap.sa.edit', compact('sa'));

    }

    public function hapus($id_sa){
        $delete = DB::table('sa')
        ->where('id_sa', $id_sa)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }




}
