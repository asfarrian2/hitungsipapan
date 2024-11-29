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
        ->whereNotNull('hitung.pengajuan')
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

        return view('cetakpap', compact('hitung'));
    }




}
