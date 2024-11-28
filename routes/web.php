<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\WpController;
use App\Http\Controllers\WpapController;
use App\Http\Controllers\UppdController;
use App\Http\Controllers\ObjekController;
use App\Http\Controllers\HdapController;
use App\Http\Controllers\FewController;
use App\Http\Controllers\FnapController;
use App\Http\Controllers\LaController;
use App\Http\Controllers\LpController;
use App\Http\Controllers\VaController;
use App\Http\Controllers\KaController;
use App\Http\Controllers\KdsController;
use App\Http\Controllers\KpController;
use App\Http\Controllers\FkpapController;
use App\Models\Uppd;
use App\Models\User;
use App\Models\wp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Proses Login User/Admin

Route::middleware(['guest:user'])->group(function () {

    Route::get('/panel', function () {
    return view('admin.login');
})->name('loginadmin');
Route::post('/login_proses', [AuthController::class, 'login_proses']);
});

Route::middleware(['role:admin hitungpajakpap,user'])->group(function () {

Route::get('/admin/dashboard', [DashboardController::class, 'dashboard']);
Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
//perusahaan
Route::get('/perusahaan/view', [PerusahaanController::class, 'view']);
Route::get('/perusahaan/create', [PerusahaanController::class, 'create']);
Route::post('/perusahaan/store', [PerusahaanController::class, 'store']);
Route::get('/perusahaan/{id_wajibpajak}/hapus', [PerusahaanController::class, 'hapus']);
Route::get('/perusahaan/{id_wajibpajak}/edit', [PerusahaanController::class, 'edit']);
Route::post('/perusahaan/update', [PerusahaanController::class, 'update']);
Route::get('/perusahaan/{id_wajibpajak}/reset', [PerusahaanController::class, 'reset']);
//uppd
Route::get('/uppd/view', [UppdController::class, 'view']);
Route::get('/uppd/create', [UppdController::class, 'create']);
Route::post('/uppd/store', [UppdController::class, 'store']);
Route::get('/uppd/{id_unit}/hapus', [UppdController::class, 'hapus']);
Route::get('/uppd/{id_unit}/edit', [UppdController::class, 'edit']);
Route::post('/uppd/update', [UppdController::class, 'update']);
Route::get('/uppd/{id_unit}/reset', [UppdController::class, 'reset']);
//hdap
Route::get('/hdap/view', [HdapController::class, 'view']);
Route::post('/hdap/store', [HdapController::class, 'store']);
Route::get('/hdap/{id_hdap}/hapus', [HdapController::class, 'hapus']);
Route::get('/hdap/{id_hdap}/edit', [HdapController::class, 'edit']);
Route::post('/hdap/update', [HdapController::class, 'update']);
//hdap
Route::get('/few/view', [FewController::class, 'view']);
Route::post('/few/store', [FewController::class, 'store']);
Route::get('/few/{id_few}/hapus', [FewController::class, 'hapus']);
Route::get('/few/{id_few}/edit', [FewController::class, 'edit']);
Route::post('/few/update', [FewController::class, 'update']);
//sa
Route::get('/sa/view', [FnapController::class, 'view']);
Route::post('/sa/store', [FnapController::class, 'store']);
Route::get('/sa/{id_sa}/hapus', [FnapController::class, 'hapus']);
Route::get('/sa/{id_sa}/edit', [FnapController::class, 'edit']);
Route::post('/sa/update', [FnapController::class, 'update']);
//la
Route::get('/la/view', [LaController::class, 'view']);
Route::post('/la/store', [LaController::class, 'store']);
Route::get('/la/{id_la}/hapus', [LaController::class, 'hapus']);
Route::get('/la/{id_la}/edit', [LaController::class, 'edit']);
Route::post('/la/update', [LaController::class, 'update']);
//lp
Route::get('/lp/view', [LpController::class, 'view']);
Route::post('/lp/store', [LpController::class, 'store']);
Route::get('/lp/{id_lp}/hapus', [LpController::class, 'hapus']);
Route::get('/lp/{id_lp}/edit', [LpController::class, 'edit']);
Route::post('/lp/update', [LpController::class, 'update']);
//va
Route::get('/va/view', [VaController::class, 'view']);
Route::post('/va/store', [VaController::class, 'store']);
Route::get('/va/{id_va}/hapus', [VaController::class, 'hapus']);
Route::get('/va/{id_va}/edit', [VaController::class, 'edit']);
Route::post('/va/update', [VaController::class, 'update']);
//ka
Route::get('/ka/view', [KaController::class, 'view']);
Route::post('/ka/store', [KaController::class, 'store']);
Route::get('/ka/{id_ka}/hapus', [KaController::class, 'hapus']);
Route::get('/ka/{id_ka}/edit', [KaController::class, 'edit']);
Route::post('/ka/update', [KaController::class, 'update']);
//kds
Route::get('/kds/view', [KdsController::class, 'view']);
Route::post('/kds/store', [KdsController::class, 'store']);
Route::get('/kds/{id_kds}/hapus', [KdsController::class, 'hapus']);
Route::get('/kds/{id_kds}/edit', [KdsController::class, 'edit']);
Route::post('/kds/update', [KdsController::class, 'update']);
//kp
Route::get('/kp/view', [KpController::class, 'view']);
Route::post('/kp/store', [KpController::class, 'store']);
Route::get('/kp/{id_kp}/hapus', [KpController::class, 'hapus']);
Route::get('/kp/{id_kp}/edit', [KpController::class, 'edit']);
Route::post('/kp/update', [KpController::class, 'update']);
//fkpap
Route::get('/fkpap/view', [FkpapController::class, 'view']);
Route::post('/fkpap/store', [FkpapController::class, 'store']);
Route::get('/fkpap/{id_fkpap}/hapus', [FkpapController::class, 'hapus']);
Route::get('/fkpap/{id_fkpap}/edit', [FkpapController::class, 'edit']);
Route::post('/fkpap/update', [FkpapController::class, 'update']);

});

Route::middleware(['guest:uppd'])->group(function () {

    Route::get('/auth', function () {
        return view('auth.loginoperator');
    })->name('login');
    Route::post('/login_operator', [AuthController::class, 'login_operator']);
    });

    Route::get('/test', function () {
        $id_sa          = 100;
        $id_la          = 100;
        $id_lp          = 100;
        $id_va          = 30;
        $id_ka          = 90;
        $id_kds         = 120;
        $id_kp          = 100;
        echo ($id_sa/100)*($id_la/100)*($id_lp/100)*($id_va/100)*($id_ka/100)*($id_kds/100)*($id_kp/100)*100*300*(85/100);
    });


Route::middleware(['auth:uppd'])->group(function () {

    Route::get('/operator/dashboard', [DashboardController::class, 'dashboard_operator']);
    Route::get('/logout_operator', [AuthController::class, 'logout_operator']);
    //Data Perusahaan/PAP
    Route::get('/operator/wp/view', [WpController::class, 'view']);
    Route::get('/operator/wp/create', [WpController::class, 'create']);
    Route::post('/operator/wp/store', [WpController::class, 'store']);
    Route::get('/operator/wp/{id_wajibpajak}/hapus', [WpController::class, 'hapus']);
    Route::get('/operator/wp/{id_wajibpajak}/edit', [WpController::class, 'edit']);
    Route::post('/operator/wp/update', [WpController::class, 'update']);
    Route::get('/operator/wp/{id_wajibpajak}/reset', [WpController::class, 'reset']);
    //Data Objek Pajak
    Route::get('/operator/objek/{id_wajibpajak}/detail', [ObjekController::class, 'detail']);
    Route::post('/operator/objek/store', [ObjekController::class, 'store']);
    Route::get('/operator/objek/{id_objek}/hapus', [ObjekController::class, 'hapus']);
    Route::get('/operator/objek/{id_objek}/edit', [ObjekController::class, 'edit']);
    Route::post('/operator/objek/update', [ObjekController::class, 'update']);

});






//akun wp
Route::middleware(['guest:wp'])->group(function () {
    Route::get('/', function () {
        return view('welcome');});

    Route::get('/login_wp', function () {
    return view('auth.loginwp');
})->name('loginwp');
Route::get('/auth_wp', function () {
    return view('auth.loginwp');
})->name('loginwp');
Route::post('/proses_login_wp', [AuthController::class, 'proses_login_wp']);
});

Route::middleware(['auth:wp'])->group(function () {
Route::get('/wp/home', [DashboardController::class, 'home']);
Route::get('/wp/histori', [WpapController::class, 'view']);
Route::post('/wp/create/{id_objek}', [WpapController::class, 'create']);
Route::post('/wp/hitung/{id_objek}', [WpapController::class, 'hitung']);
Route::get('/wp/hasil/{id_objek}', [WpapController::class, 'hasil']);
Route::get('/wp/cetak/{id_objek}', [WpapController::class, 'cetak']);
Route::get('/wp/store', [WpapController::class, 'store']);
Route::get('/logout_wp', [AuthController::class, 'logout_wp']);
});

Route::get('/auth_wp', function () {
    return view('auth.loginwp');});







Route::get('/createrolepermission', function () {

    try {
        Role::create(['name' => 'admin hitungpajakpap']);
        Permission::create(['name' => 'view-perusahaan']);
        Permission::create(['name' => 'view-uppd']);
        echo "Sukses";
    } catch (\Exception $e) {
        echo "Error";
    }
});

Route::get('/give-user-role', function () {
    try {
        $user = User::findorfail(1);
        $user->assignRole('admin hitungpajakpap');
        echo "Sukses";
    } catch (\Exception $e) {
        //throw $th;
        echo "Error";
    }
});
