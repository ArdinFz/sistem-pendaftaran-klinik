<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PoliklinikController;
use App\Http\Controllers\Admin\JadwalDokterController;
use App\Http\Controllers\Admin\LaporanController;

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

Route::get('/', function () {
    return view('welcome');
});

// route untuk autentikasi akun
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('authenticate');

Route::any('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::prefix('admin')
    ->middleware(['auth'])
    ->as('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class);

        Route::get('/pasien', [PasienController::class, 'index'])
            ->name('pasien.index');

        Route::get('/pasien/{id}', [PasienController::class, 'show'])
            ->name('pasien.show');

        Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])
            ->name('pasien.edit');

        Route::put('/pasien/{id}', [PasienController::class, 'update'])
            ->name('pasien.update');

        Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])
            ->name('pasien.destroy');

        Route::resource('dokter', DokterController::class);

        Route::resource('poliklinik', PoliklinikController::class);

        Route::resource('jadwal-dokter', JadwalDokterController::class);

        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::post('/laporan/filter', [LaporanController::class, 'filter'])
            ->name('laporan.filter');

        Route::get('/laporan/cetak', [LaporanController::class, 'cetakPdf'])
            ->name('laporan.cetak');

        Route::get('/laporan/detail/{id}', [LaporanController::class, 'show'])
            ->name('laporan.show');

        Route::get('/laporan/detail/{id}/cetak', [LaporanController::class, 'cetakBukti'])
            ->name('laporan.cetak-bukti');
    });

Route::prefix('pegawai')
    ->middleware(['auth'])
    ->as('pegawai.')
    ->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Pegawai\DashboardController::class, 'index'])
            ->name('dashboard');
            
        Route::post('/dashboard/panggil/{id}', [App\Http\Controllers\Pegawai\DashboardController::class, 'panggil'])
            ->name('dashboard.panggil');
            
        Route::post('/dashboard/selesai/{id}', [App\Http\Controllers\Pegawai\DashboardController::class, 'selesai'])
            ->name('dashboard.selesai');
            
        Route::get('/dashboard/refresh', [App\Http\Controllers\Pegawai\DashboardController::class, 'refresh'])
            ->name('dashboard.refresh');

        Route::get('/pendaftaran', [App\Http\Controllers\Pegawai\PendaftaranController::class, 'index'])
            ->name('pendaftaran.index');

        Route::get('/pendaftaran/{id}', [App\Http\Controllers\Pegawai\PendaftaranController::class, 'show'])
            ->name('pendaftaran.show');
    });