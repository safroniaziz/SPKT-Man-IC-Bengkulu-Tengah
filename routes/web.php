<?php

use App\Http\Controllers\AuthPimpinan\LoginPimpinanController;
use App\Http\Controllers\KepsekDashboardController;
use App\Http\Controllers\TendikDashboardController;
use App\Http\Controllers\TuDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
    // return view('layouts.layout');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'  => 'tendik/'],function(){
    Route::get('/',[TendikDashboardController::class, 'dashboard'])->name('tendik.dashboard');
    Route::post('/',[TendikDashboardController::class, 'post'])->name('tendik.post');
    Route::patch('{kegId}/',[TendikDashboardController::class, 'update'])->name('tendik.update');
});

Route::group(['prefix'  => ''],function(){
    Route::get('/pimpinan/login',[LoginPimpinanController::class, 'showLoginForm'])->name('pimpinan.login');
    Route::post('/pimpinan/login',[LoginPimpinanController::class, 'login'])->name('pimpinan.login.submit');
    Route::get('/logout',[LoginPimpinanController::class, 'logoutTendik'])->name('pimpinan.logout');
});

Route::group(['prefix'  => 'kepala_sekolah'],function(){
    Route::get('/',[KepsekDashboardController::class, 'dashboard'])->name('kepala_sekolah.dashboard');
    route::get('/karyawan',[KepsekDashboardController::class, 'detailKaryawan'])->name('kepala_sekolah.cari_detail_karyawan');
    Route::post('/',[KepsekDashboardController::class, 'update'])->name('kepala_sekolah.update');
});

Route::group(['prefix'  => 'tata_usaha'],function(){
    Route::get('/',[TuDashboardController::class, 'dashboard'])->name('tu.dashboard');
    route::get('/karyawan',[TuDashboardController::class, 'detailKaryawan'])->name('tu.cari_detail_karyawan');
    Route::post('/',[TuDashboardController::class, 'update'])->name('tu.update');
});