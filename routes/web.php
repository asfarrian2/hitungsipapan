<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\WpController;
use App\Http\Controllers\UppdController;
use App\Models\Uppd;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');});

Route::middleware(['guest:user'])->group(function () {

    Route::get('/panel', function () {
    return view('admin.login');
})->name('loginadmin');
Route::post('/login_proses', [AuthController::class, 'login_proses']);
    });

Route::middleware(['auth:user'])->group(function () {

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

});

Route::middleware(['guest:uppd'])->group(function () {

    Route::get('/auth', function () {
        return view('auth.loginoperator');
    })->name('login');
    Route::post('/login_operator', [AuthController::class, 'login_operator']);
    });


Route::middleware(['auth:uppd'])->group(function () {

    Route::get('/operator/dashboard', [DashboardController::class, 'dashboard_operator']);
    Route::get('/logout_operator', [AuthController::class, 'logout_operator']);
    Route::get('/operator/wp/view', [WpController::class, 'view']);
    Route::get('/operator/wp/create', [WpController::class, 'create']);
    Route::post('/operator/wp/store', [WpController::class, 'store']);
    Route::get('/operator/wp/{id_wajibpajak}/hapus', [WpController::class, 'hapus']);
    Route::get('/operator/wp/{id_wajibpajak}/edit', [WpController::class, 'edit']);
    Route::post('/operator/wp/update', [WpController::class, 'update']);
    Route::get('/operator/wp/{id_wajibpajak}/reset', [WpController::class, 'reset']);
});
