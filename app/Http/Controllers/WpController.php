<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class WpController extends Controller
{
    public function view(){
        $perusahaan = DB::table('tb_wp')
        ->join('tb_uppd', 'tb_wp.id_unit', '=', 'tb_uppd.id_unit')
        ->select('tb_wp.*', 'tb_uppd.nama_unit')
        ->get();

        return view ('operator.perusahaan.view', compact('perusahaan'));

    }

    public function create(){
        $uppd = DB::table('tb_uppd')
        ->get();

        return view('operator.perusahaan.create', compact('uppd'));
    }

    public function store(Request $request){
        $id_wajibpajak = $request->id_wajibpajak;
        $nama     = $request->nama;
        $alamat   = $request->alamat;
        $kegiatan = $request->kegiatan;
        $no_telp  = $request->no_telp;
        $email    = $request->email;
        $unit     = $request->unit;
        $password = Hash::make('12345');

        $cekkode = DB::table('tb_wp')
        ->where('id_wajibpajak', $id_wajibpajak)
        ->where('email', $email)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'ID/Email Wajib Pajak Sudah Digunakan']);
         }
        try {
            $data = [
                'id_wajibpajak' => $id_wajibpajak,
                'nama'      => $nama,
                'alamat'    => $alamat,
                'kegiatan'  => $kegiatan,
                'no_telp'   => $no_telp,
                'email'     => $email,
                'id_unit'   => $unit,
                'password'  => $password
            ];
            DB::table('tb_wp')->insert($data);
            return redirect('/operator/wp/view')->with(['success' => 'Data Berhasil Disimpan !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan !']);
            }
    }

    public function edit($id_wajibpajak){


        $perusahaan = DB::table('tb_wp')
        ->where('id_wajibpajak', $id_wajibpajak)
        ->first();

        $uppd = DB::table('tb_uppd')
        ->get();

        return view('operator.perusahaan.edit', compact('perusahaan', 'uppd'));
    }


    public function update(Request $request)
    {
        $id_wajibpajak_baru = $request->id_wajibpajak_baru;
        $id_wajibpajak = $request->id_wajibpajak;
        $nama     = $request->nama;
        $alamat   = $request->alamat;
        $kegiatan = $request->kegiatan;
        $no_telp  = $request->no_telp;
        $email    = $request->email;
        $unit     = $request->unit;

        $cekkode = DB::table('tb_wp')
        ->where('id_wajibpajak', $id_wajibpajak_baru)
        ->where('id_wajibpajak', '!=', $id_wajibpajak)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'ID WP Sudah Digunakan']);
         }
        try {
        $data =  [
            'id_wajibpajak' => $id_wajibpajak_baru,
            'nama'      => $nama,
            'alamat'    => $alamat,
            'kegiatan'  => $kegiatan,
            'no_telp'   => $no_telp,
            'email'     => $email,
            'id_unit'   => $unit
            ];

            $update = DB::table('tb_wp')->where('id_wajibpajak', $id_wajibpajak)->update($data);
            return redirect('/operator/wp/view')->with(['success' => 'Data Berhasil Diiubah !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }
     }


    public function hapus($id_wajibpajak)
    {
       $delete = DB::table('tb_wp')->where('id_wajibpajak', $id_wajibpajak)->delete();
       if ($delete) {
           return redirect('/operator/wp/view')->with(['success' => 'Data Berhasil Dihapus !']);
       } else {
           return Redirect::back()->with(['warning' => 'Data Gagal Dihapus !']);
       }
    }

    public function reset($id_wajibpajak)
    {
        $data =  [
            'password'   => Hash::make('12345')
        ];

       $update = DB::table('tb_wp')
       ->where('id_wajibpajak', $id_wajibpajak)
       ->update($data);
       if ($update) {
           return redirect('/operator/wp/view')->with(['success' => 'Password Berhasil Direset !']);
       } else {
           return Redirect::back()->with(['warning' => 'Password Gagal Direset !']);
       }
    }
}
