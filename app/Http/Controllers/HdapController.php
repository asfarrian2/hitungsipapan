<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class HdapController extends Controller
{
    public function view(){

        $hdap = DB::table('hdap')
        ->get();

        return view('hdap.view', compact('hdap'));
    }


    public function store(Request $request){

        $kelompok_hdap  = $request->kelompok_hdap;
        $nilai_hdap     = $request->nilai_hdap;

        $data=[
            'kelompok_hdap' => $kelompok_hdap,
            'nilai_hdap'    => $nilai_hdap
        ];

        $insert=DB::table('hdap')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }


    public function edit($id_hdap){
        $hdap = DB::table('hdap')
        ->where('id_hdap', $id_hdap)
        ->first();
        return view('hdap.edit', compact('hdap'));

    }

    public function update(Request $request){

        $id_hdap    = $request->id_hdap;
        $kelompok_hdap  = $request->kelompok_hdap;
        $nilai_hdap    = $request->nilai_hdap;

        $data =  [
            'kelompok_hdap' => $kelompok_hdap,
            'nilai_hdap'   => $nilai_hdap,
            ];

            $update = DB::table('hdap')->where('id_hdap', $id_hdap)->update($data);
            if ($update){
                return Redirect('/hdap/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


    public function hapus($id_hdap){
        $delete = DB::table('hdap')
        ->where('id_hdap', $id_hdap)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }


}
