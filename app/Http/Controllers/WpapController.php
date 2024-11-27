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

    public function create($id_objek){

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

        $m3 = $request -> m3;

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
        ->where('id_objek',$id_objek)
        ->first();

        // RUMUS
        $tarif = '0.1'; //100%
        $npap  = $objek_pajak->npap;
        $hasil = $tarif*$npap*$m3;

        return view('hasil', compact ('npap','hasil'));

    }

    public function store(Request $request){

        $hitung=DB::table('hitung')
        ->latest('id_objek', 'DESC')
        ->first();

        $kodehitung ="HT";

        if($hitung == null){
            $nomorurut = "0000000000001";
        }else{
            $nomorurut = substr($hitung->id_objek, 2, 13) + 1;
            $nomorurut = str_pad($nomorurut, 13, "0", STR_PAD_LEFT);
        }
        $id=$hitung.$nomorurut;
        $id_objek = $request->id_objek;

    }

}
