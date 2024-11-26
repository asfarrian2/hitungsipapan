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
        ->get();

        $perusahaan = DB::table('tb_wp')
        ->where('id_wajibpajak',$id_wajibpajak)
        ->first();

        $hdap = DB::table('hdap')
        ->get();
        $few = DB::table('few')
        ->get();
        $sa = DB::table('sa')
        ->get();
        $la = DB::table('la')
        ->get();
        $lp = DB::table('lp')
        ->get();
        $va = DB::table('va')
        ->get();
        $ka = DB::table('ka')
        ->get();
        $kds = DB::table('kds')
        ->get();
        $kp = DB::table('kp')
        ->get();
        $fkpap = DB::table('fkpap')
        ->get();


        return view('operator.objek.view', compact('objek', 'perusahaan', 'hdap',
        'few', 'sa', 'la', 'lp', 'va', 'ka', 'kds', 'kp', 'fkpap'));
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
        $id_hdap        = $request->id_hdap;
        $id_few         = $request->id_few;
        $id_sa          = $request->id_sa;
        $id_la          = $request->id_la;
        $id_lp          = $request->id_lp;
        $id_va          = $request->id_va;
        $id_ka          = $request->id_ka;
        $id_kds         = $request->id_kds;
        $id_kp          = $request->id_kp;
        $id_fkpap       = $request->id_fkpap;


        $data=[
            'id_objek'      => $id,
            'id_wajibpajak' => $id_wajibpajak,
            'nama_objek'    => $nama,
            'id_hdap'       => $id_hdap,
            'id_few'        => $id_few,
            'id_sa'         => $id_sa,
            'id_la'         => $id_la,
            'id_lp'         => $id_lp,
            'id_va'         => $id_va,
            'id_ka'         => $id_ka,
            'id_kds'        => $id_kds,
            'id_kp'         => $id_kp,
            'id_fkpap'      => $id_fkpap
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

        $hdap = DB::table('hdap')
        ->get();
        $few = DB::table('few')
        ->get();
        $sa = DB::table('sa')
        ->get();
        $la = DB::table('la')
        ->get();
        $lp = DB::table('lp')
        ->get();
        $va = DB::table('va')
        ->get();
        $ka = DB::table('ka')
        ->get();
        $kds = DB::table('kds')
        ->get();
        $kp = DB::table('kp')
        ->get();
        $fkpap = DB::table('fkpap')
        ->get();


        return view('operator.objek.edit', compact('objek_pajak', 'hdap',
        'few', 'sa', 'la', 'lp', 'va', 'ka', 'kds', 'kp', 'fkpap'));

    }

    public function update(Request $request)
    {
        $id_wajibpajak = $request->id_wajibpajak;
        $id_objek = $request->id_objek;
        $nama_objek = $request->nama_objek;
        $id_hdap        = $request->id_hdap;
        $id_few         = $request->id_few;
        $id_sa          = $request->id_sa;
        $id_la          = $request->id_la;
        $id_lp          = $request->id_lp;
        $id_va          = $request->id_va;
        $id_ka          = $request->id_ka;
        $id_kds         = $request->id_kds;
        $id_kp          = $request->id_kp;
        $id_fkpap       = $request->id_fkpap;
        $data =  [
            'nama_objek' => $nama_objek,
            'id_hdap'       => $id_hdap,
            'id_few'        => $id_few,
            'id_sa'         => $id_sa,
            'id_la'         => $id_la,
            'id_lp'         => $id_lp,
            'id_va'         => $id_va,
            'id_ka'         => $id_ka,
            'id_kds'        => $id_kds,
            'id_kp'         => $id_kp,
            'id_fkpap'      => $id_fkpap
            ];

            $update = DB::table('objek_pajak')->where('id_objek', $id_objek)->update($data);
            if ($update){
                return Redirect('/operator/objek/'.$id_wajibpajak.'/detail')->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
            }
     }



}
