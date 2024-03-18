<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [\App\Http\Controllers\AuthController::class, 'login'])->name('admin.login');
Route::post('/', [\App\Http\Controllers\AuthController::class, 'attempt'])->name('admin.attempt');

Route::middleware('admin')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/manajemen-penggajian', [\App\Http\Controllers\AdminController::class, 'gaji'])->name('gaji');
        Route::get('/manajemen-tunjangan', [\App\Http\Controllers\AdminController::class, 'tunjangan'])->name('tunjangan');
        Route::get('/manajemen-jabatan', [\App\Http\Controllers\AdminController::class, 'jabatan'])->name('jabatan');
        Route::get('/cetak-slipgaji/{id}', [\App\Http\Controllers\AdminController::class, 'cetakSlipGaji'])->name('cetak-slipgaji');
        Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\KaryawanController::class, 'index'])->name('index');
        Route::post('/login', [\App\Http\Controllers\KaryawanController::class, 'login'])->name('login');
        Route::post('/store', [\App\Http\Controllers\KaryawanController::class, 'store'])->name('store');
        Route::get('/show/{id}', [\App\Http\Controllers\KaryawanController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\KaryawanController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [\App\Http\Controllers\KaryawanController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\KaryawanController::class, 'destroy'])->name('delete');
    });

    Route::prefix('jabatan')->name('jabatan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\JabatanController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\JabatanController::class, 'store'])->name('store');
        Route::get('/show/{id}', [\App\Http\Controllers\JabatanController::class, 'show'])->name('show');
        Route::put('/update/{id}', [\App\Http\Controllers\JabatanController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\JabatanController::class, 'destroy'])->name('delete');
    });

    Route::prefix('perizinan')->name('perizinan.')->group(function () {
        Route::get('/{id}', [\App\Http\Controllers\PerizinanController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\PerizinanController::class, 'store'])->name('store');
    });

    Route::prefix('penggajian')->name('gaji.')->group(function () {
        Route::get('/', [\App\Http\Controllers\SlipGajiController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\SlipGajiController::class, 'store'])->name('store');
        Route::put('/update/{id}', [\App\Http\Controllers\SlipGajiController::class, 'update'])->name('update');
    });

    Route::prefix('tunjangan')->name('tunjangan.')->group(function () {
        Route::get('/{id_slip_gaji}', [\App\Http\Controllers\TunjanganController::class, 'index'])->name('index');
        Route::post('/store', [\App\Http\Controllers\TunjanganController::class, 'store'])->name('store');
        Route::put('/update/{id}', [\App\Http\Controllers\TunjanganController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [\App\Http\Controllers\TunjanganController::class, 'destroy'])->name('delete');
    });
});