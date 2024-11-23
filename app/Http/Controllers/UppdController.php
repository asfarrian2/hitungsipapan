<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UppdController extends Controller
{
    public function view(){
        $uppd = DB::table('tb_uppd')
        ->get();

        return view('uppd.view', compact('uppd'));
    }

    public function create(){
        return view('uppd.create');
    }

    public function store(Request $request){

        $id_unit    = $request->id_unit;
        $nama_unit  = $request->nama_unit;
        $no_telp    = $request->no_telp;
        $email      = $request->email;
        $password   = Hash::make('12345');

        $cek_kode = DB::table('tb_uppd')
        ->where('id_unit', $id_unit)
        ->where('email', $email)
        ->count();
        if ($cek_kode > 0) {
            return Redirect::back()->with(['warning' => 'ID/Email Sudah Digunakan !']);
        }
        try{
            $data = [
                'id_unit'   => $id_unit,
                'nama_unit' => $nama_unit,
                'no_telp'   => $no_telp,
                'email'     => $email,
                'password'  => $password
            ];
            DB::table('tb_uppd')->insert($data);
            return redirect('/uppd/view')->with(['success' => 'Data Berhasil Disimpan !']);
            }catch (\exception $e) {
                return Redirect::back()->with(['warning' => 'Data Gagal Disimpan !']);
            }

        }

    public function edit($id_unit){
        $uppd = DB::table('tb_uppd')
        ->where('id_unit',$id_unit)
        ->first();

        return view('uppd.edit', compact('uppd'));
    }

    public function update(Request $request){
        $id_unit_baru=$request->id_unit_baru;
        $id_unit    = $request->id_unit;
        $nama_unit  = $request->nama_unit;
        $no_telp    = $request->no_telp;
        $email      = $request->email;

        $cekkode = DB::table('tb_wp')
        ->where('id_unit', $id_unit_baru)
        ->where('id_unit', '!=', $id_unit)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'ID UPPD Sudah Digunakan']);
         }
        try {
        $data =  [
            'id_unit'   => $id_unit_baru,
            'nama_unit' => $nama_unit,
            'no_telp'   => $no_telp,
            'email'     => $email
            ];

            $update = DB::table('tb_uppd')->where('id_unit', $id_unit)->update($data);
            return redirect('/uppd/view')->with(['success' => 'Data Berhasil Diiubah !']);
            } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diubah !']);
            }
    }

    public function hapus($id_unit){
        $delete = DB::table('tb_uppd')
        ->where('id_unit', $id_unit)
        ->delete();

        if ($delete){
            return redirect('uppd/view')->with(['success' => 'Data Berhasil Dihapus']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
            }
    }

    public function reset($id_unit)
    {
        $data =  [
            'password'   => Hash::make('12345')
        ];

       $update = DB::table('tb_uppd')
       ->where('id_unit', $id_unit)
       ->update($data);
       if ($update) {
           return redirect('/uppd/view')->with(['success' => 'Password Berhasil Direset !']);
       } else {
           return Redirect::back()->with(['warning' => 'Password Gagal Direset !']);
       }
    }

}
