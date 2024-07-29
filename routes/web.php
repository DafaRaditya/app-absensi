<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;

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

Route::get('/', [AbsensiController::class, 'create'])->name('absensi.create');
Route::post('/store', [AbsensiController::class, 'store'])->name('absensi.store');



Auth::routes(['register' => false]);



Route::get('home', function(){
    return redirect()->route('absensi.index');
});

Route::prefix('admin')->group(function () {
    Route::resource('karyawan', KaryawanController::class)->middleware('auth');

    // data absen
    Route::get('data', [AbsensiController::class, 'index'])->name('absensi.index')->middleware('auth');


    // pencarian data absen
    // Route::get('data/search' , [AbsensiController::class , 'search'])->name('absensi.search')->middleware('auth');
    
    Route::get('data-bulanan', [AbsensiController::class, 'dataBulanan'])->name('absensi.data-bulanan')->middleware('auth');
    
    // export data absensi
    Route::get('export-data', [AbsensiController::class, 'absensiExport'])->name('export-data');

});


