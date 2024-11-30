<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class WpapController extends Controller
{

    public function view(){
        $id_wajibpajak = Auth::guard('wp')->user()->id_wajibpajak;
        $hitung = DB::table('hitung')
        ->leftJoin('objek_pajak', 'hitung.id_objek', '=', 'objek_pajak.id_objek')
        ->leftJoin('tb_wp', 'objek_pajak.id_wajibpajak', '=', 'tb_wp.id_wajibpajak')
        ->where('hitung.id_wajibpajak',$id_wajibpajak)
        ->whereNot('hitung.status', '0')
        ->orderBy('id_hitung', 'DESC')
        ->get();

        return view('view_histori', compact('hitung'));
    }

    public function create($id_objek, Request $request){

        $id_objek = $request->id_objek;
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
        ->leftjoin('tb_wp', 'objek_pajak.id_wajibpajak', '=', 'tb_wp.id_wajibpajak')
        ->where('id_objek', $id_objek)
        ->first();

        return view('hitungpap', compact('objek_pajak'));
    }

    public function hitung($id_objek, Request $request){

        $id_objek = $request -> id_objek;
        $m3 = $request -> m3;
        $id_wajibpajak = Auth::guard('wp')->user()->id_wajibpajak;

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
            return redirect('/wp/hasil/'.$id);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }

    }

    public function hasil($id_hitung, Request $request){



        $id_wajibpajak = Auth::guard('wp')->user()->id_wajibpajak;
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

        return view('hasil', compact('hitung', 'cfnap'));
    }

    public function cetak($id_hitung, Request $request){

        $id_wajibpajak = Auth::guard('wp')->user()->id_wajibpajak;
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

    public function ajukan($id_hitung){
        $data=[
            'status' => '1'
        ];

        $update= DB::table('hitung')
        ->where('id_hitung', $id_hitung)
        ->update($data);
        if ($update){
        return redirect('/wp/histori')->with(['success' => 'Data Berhasil Diajukan']);
        }else{
            echo 'Gagal';
            }
        }

        public function upload(Request $request){
            $id_hitung = $request->id_hitung;
            $request->validate([

            ]);
            if ($request->hasFile('dokumen')) {
                $dokumen = $id_hitung . "." . $request->file('dokumen')->getClientOriginalExtension();
            } else {
                $dokumen = $id_hitung;
            }

            $data2=[
                'pengajuan' => NULL
            ];
            $update1=DB::table('hitung')
            ->where('id_hitung',$id_hitung)
            ->update($data2);

            $data=[
                'pengajuan' => $dokumen,
                'status'    => 1
            ];
            $update=DB::table('hitung')
            ->where('id_hitung',$id_hitung)
            ->update($data);
            if ($update){
                if ($request->hasFile('dokumen')) {
                    $folderPath = "public/uploads/laporan/";
                    $request->file('dokumen')->storeAs($folderPath, $dokumen);
                }
                return redirect('/wp/histori')->with(['success' => 'Dokumen Berhasil Diupload']);
                }else{
                    return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
                }
        }

        public function download($id_hitung){
            $path = Storage::path('public/uploads/laporan/'.$id_hitung.'.pdf');
            if ($path){
            return response()->file($path);
            } else
            abort(404);
        }

        public function batal($id_hitung){
            $data=[
                'pengajuan' => null,
                'status'    => 0
            ];
            $update=DB::table('hitung')
            ->where('id_hitung',$id_hitung)
            ->update($data);
            if ($update){
                return redirect('/wp/histori')->with(['success' => 'Pengajuan Berhasil Dibatalkan']);
                }else{
                    return Redirect::back()->with(['warning' => 'Pengajuan Gagal Dibatalkan']);
                }
        }

}
