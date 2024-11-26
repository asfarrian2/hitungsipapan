<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class FewController extends Controller
{
    public function view(){

        $few = DB::table('few')
        ->get();

        return view('few.view', compact('few'));
    }

    public function store(Request $request){

        $nilai_pdrb     = $request->nilai_pdrb;
        $faktor_few     = $request->faktor_few;

        $data=[
            'nilai_pdrb'    => $nilai_pdrb,
            'faktor_few'    => $faktor_few
        ];

        $insert=DB::table('few')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
    }

    public function hapus($id_few){
        $delete = DB::table('few')
        ->where('id_few', $id_few)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

    public function edit($id_few){
        $few = DB::table('few')
        ->where('id_few', $id_few)
        ->first();
        return view('few.edit', compact('few'));

    }

    public function update(Request $request){

        $id_few    = $request->id_few;
        $nilai_pdrb  = $request->nilai_pdrb;
        $faktor_few    = $request->faktor_few;

        $data =  [
            'nilai_pdrb' => $nilai_pdrb,
            'faktor_few'   => $faktor_few,
            ];

            $update = DB::table('few')->where('id_few', $id_few)->update($data);
            if ($update){
                return Redirect('/few/view')->with(['success' => 'Data Berhasil Diubah']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Diubah']);
            }
    }


}
