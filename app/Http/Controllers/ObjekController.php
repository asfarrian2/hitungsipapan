<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ObjekController extends Controller
{
    public function detail($id_wajibpajak){
        $objek = DB::table('objek_pajak')
        ->where('id_wajibpajak',$id_wajibpajak)
        ->get();

        $perusahaan = DB::table('tb_wp')
        ->where('id_wajibpajak',$id_wajibpajak)
        ->first();

        return view('operator.objek.view', compact('objek', 'perusahaan'));
    }

    public function store(Request $request){
        $objek_pajak=DB::table('objek_pajak')
        ->latest('id_objek', 'DESC')
        ->first();

        $kodeobjek ="OP";

        if($objek_pajak == null){
            $nomorurut = "000001";
        }else{
            $nomorurut = substr($objek_pajak->id_objek, 2, 6) + 1;
            $nomorurut = str_pad($nomorurut, 6, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $id_wajibpajak  = $request->id_wajibpajak;
        $nama           = $request->nama;

        $data=[
            'id_objek'      => $id,
            'id_wajibpajak' => $id_wajibpajak,
            'nama_objek'    => $nama
        ];

        $insert=DB::table('objek_pajak')->insert($data);
        if ($insert){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }

    }

    public function hapus($id_objek){
        $delete = DB::table('objek_pajak')
        ->where('id_objek', $id_objek)
        ->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

    public function edit($id_objek){
        $objek_pajak = DB::table('objek_pajak')
        ->select('objek_pajak.*', 'tb_wp.nama')
        ->join('tb_wp', 'objek_pajak.id_wajibpajak', '=', 'tb_wp.id_wajibpajak')
        ->where('id_objek', $id_objek)
        ->first();
        return view('operator.objek.edit', compact('objek_pajak'));

    }

    public function update(Request $request)
    {
        $id_wajibpajak = $request->id_wajibpajak;
        $id_objek = $request->id_objek;
        $nama_objek = $request->nama_objek;
        $data =  [
            'nama_objek' => $nama_objek
            ];

            $update = DB::table('objek_pajak')->where('id_objek', $id_objek)->update($data);
            if ($update){
                return Redirect('/operator/objek/'.$id_wajibpajak.'/detail')->with(['success' => 'Data Berhasil Dihapus']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
            }
     }



}
