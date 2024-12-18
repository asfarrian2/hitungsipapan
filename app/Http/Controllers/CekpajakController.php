<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CekpajakController extends Controller
{
    public function view(){
        $id_unit = Auth::guard('uppd')->user()->id_unit;
        $hitung = DB::table('hitung')
        ->leftJoin('objek_pajak', 'hitung.id_objek', '=', 'objek_pajak.id_objek')
        ->leftJoin('tb_wp', 'objek_pajak.id_wajibpajak', '=', 'tb_wp.id_wajibpajak')
        ->where('hitung.id_unit',$id_unit)
        ->whereNot('hitung.status', '0')
        ->orderBy('id_hitung', 'DESC')
        ->get();

        return view('operator.objek.view_histori', compact('hitung'));
    }

    public function cetak($id_hitung){

        $hitung = DB::table('hitung')
        ->leftJoin('tb_wp', 'hitung.id_wajibpajak', '=', 'tb_wp.id_wajibpajak')
        ->leftJoin('tb_uppd', 'tb_wp.id_unit', '=', 'tb_uppd.id_unit')
        ->leftJoin('objek_pajak', 'hitung.id_objek', '=', 'objek_pajak.id_objek')
        ->leftJoin('hdap', 'objek_pajak.id_hdap', '=', 'hdap.id_hdap')
        ->leftJoin('few', 'objek_pajak.id_few', '=', 'few.id_few')
        ->leftJoin('sa', 'objek_pajak.id_sa', '=', 'sa.id_sa')
        ->leftJoin('la', 'objek_pajak.id_la', '=', 'la.id_la')
        ->leftJoin('lp', 'objek_pajak.id_lp', '=', 'lp.id_lp')
        ->leftJoin('va', 'objek_pajak.id_va', '=', 'va.id_va')
        ->leftJoin('ka', 'objek_pajak.id_ka', '=', 'ka.id_ka')
        ->leftJoin('kds', 'objek_pajak.id_kds', '=', 'kds.id_kds')
        ->leftJoin('kp', 'objek_pajak.id_kp', '=', 'kp.id_kp')
        ->leftJoin('fkpap', 'objek_pajak.id_fkpap', '=', 'fkpap.id_fkpap')
        ->where('hitung.id_hitung',$id_hitung)
        ->first();
        $fnap=$hitung->fnap;
        $cfnap= $fnap*100;

        return view('cetakpap', compact('hitung', 'cfnap'));
    }

    public function verifikasi(Request $request){
       $id_hitung = $request->id_hitung;
       $verifikasi    = $request->verifikasi;
        $data=[
            'status' => $verifikasi
        ];

        $update= DB::table('hitung')
        ->where('id_hitung', $id_hitung)
        ->update($data);
        if ($update){
            return redirect('/operator/cek/view')->with(['success' => 'Verifikasi Berhasil']);
        }else{
            return Redirect::back()->with(['warning' => 'Verifikasi Gagal']);
        }

    }

    public function cancel($id_hitung){
        $data=[
            'status'    => 1
        ];
        $update=DB::table('hitung')
        ->where('id_hitung',$id_hitung)
        ->update($data);
        if ($update){
            return redirect('/operator/cek/view')->with(['success' => 'Verifikasi Berhasil Dibatalkan']);
            }else{
                return Redirect::back()->with(['warning' => 'Verifikasi Gagal Dibatalkan']);
            }
    }

    public function hitung(){
        $id_unit = Auth::guard('uppd')->user()->id_unit;
        $perusahaan=DB::table('tb_wp')->where('id_unit',$id_unit)->get();
        $objek=DB::table('objek_pajak')->get();

        return view('operator.objek.hitung', compact('perusahaan', 'objek'));

    }


    public function getobjek($id_wajibpajak){
        $objek = DB::table('objek_pajak')
        ->where('id_wajibpajak', $id_wajibpajak)
        ->get();
        return response()->json($objek);
    }


    public function convert(Request $request){

        $id_objek = $request -> objek;
        $m3 = $request -> m3;
        $id_wajibpajak = $request -> perusahaan;

        $id_unit = DB::table('tb_wp')
        ->where('id_wajibpajak', $id_wajibpajak)
        ->first();

        $uppd = $id_unit->id_unit;

        $objek_pajak = DB::table('objek_pajak')
        ->leftJoin('hdap', 'objek_pajak.id_hdap', '=', 'hdap.id_hdap')
        ->leftJoin('few', 'objek_pajak.id_few', '=', 'few.id_few')
        ->leftJoin('sa', 'objek_pajak.id_sa', '=', 'sa.id_sa')
        ->leftJoin('la', 'objek_pajak.id_la', '=', 'la.id_la')
        ->leftJoin('lp', 'objek_pajak.id_lp', '=', 'lp.id_lp')
        ->leftJoin('va', 'objek_pajak.id_va', '=', 'va.id_va')
        ->leftJoin('ka', 'objek_pajak.id_ka', '=', 'ka.id_ka')
        ->leftJoin('kds', 'objek_pajak.id_kds', '=', 'kds.id_kds')
        ->leftJoin('kp', 'objek_pajak.id_kp', '=', 'kp.id_kp')
        ->leftJoin('fkpap', 'objek_pajak.id_fkpap', '=', 'fkpap.id_fkpap')
        ->leftJoin('tb_wp', 'objek_pajak.id_wajibpajak', '=', 'tb_wp.id_wajibpajak')
        ->leftJoin('tb_uppd', 'tb_wp.id_unit', '=', 'tb_uppd.id_unit')
        ->where('id_objek',$id_objek)
        ->first();

        // RUMUS
        $fnap  = $objek_pajak->fnap;
        $jumlah_fnap = $fnap*100;
        $tarif = '0.1'; //100%
        $npap  = $objek_pajak->npap;
        $hasil = $tarif*$npap*$m3;

        //ID Hitung
        $hitung=DB::table('hitung')
        ->latest('id_hitung', 'DESC')
        ->first();

        $kodehitung ="HT";

        if($hitung == null){
            $nomorurut = "0000000000001";
        }else{
            $nomorurut = substr($hitung->id_hitung, 2, 13) + 1;
            $nomorurut = str_pad($nomorurut, 13, "0", STR_PAD_LEFT);
        }
        $id=$kodehitung.$nomorurut;
        $request->validate([
            'foto' => 'image'
        ]);
        if ($request->hasFile('foto')) {
            $foto = $id . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        $data=[
            'id_hitung' => $id,
            'id_objek' => $id_objek,
            'id_wajibpajak' => $id_wajibpajak,
            'id_unit' => $uppd,
            'status' => 0,
            'foto' => $foto,
            'tanggal' => date('Y-m-d'),
            'volume_pemakaian' => $m3,
            'jumlah_pap' => $hasil

        ];
        $insert=DB::table('hitung')->insert($data);
        $ambilfoto = DB::table('hitung')
        ->where('id_hitung', $id)
        ->first();
        if ($insert){
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/hitung/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return redirect('/operator/hasil/'.$id);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }

    }

    public function hasil($id_hitung, Request $request){

        $hitung = DB::table('hitung')
        ->leftJoin('tb_wp', 'hitung.id_wajibpajak', '=', 'tb_wp.id_wajibpajak')
        ->leftJoin('tb_uppd', 'tb_wp.id_unit', '=', 'tb_uppd.id_unit')
        ->leftJoin('objek_pajak', 'hitung.id_objek', '=', 'objek_pajak.id_objek')
        ->leftJoin('hdap', 'objek_pajak.id_hdap', '=', 'hdap.id_hdap')
        ->leftJoin('few', 'objek_pajak.id_few', '=', 'few.id_few')
        ->leftJoin('sa', 'objek_pajak.id_sa', '=', 'sa.id_sa')
        ->leftJoin('la', 'objek_pajak.id_la', '=', 'la.id_la')
        ->leftJoin('lp', 'objek_pajak.id_lp', '=', 'lp.id_lp')
        ->leftJoin('va', 'objek_pajak.id_va', '=', 'va.id_va')
        ->leftJoin('ka', 'objek_pajak.id_ka', '=', 'ka.id_ka')
        ->leftJoin('kds', 'objek_pajak.id_kds', '=', 'kds.id_kds')
        ->leftJoin('kp', 'objek_pajak.id_kp', '=', 'kp.id_kp')
        ->leftJoin('fkpap', 'objek_pajak.id_fkpap', '=', 'fkpap.id_fkpap')
        ->where('hitung.id_hitung',$id_hitung)
        ->first();

        $fnap=$hitung->fnap;
        $cfnap= $fnap*100;

        return view('operator.objek.hasil', compact('hitung', 'cfnap'));
    }





}
