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

Route::get('/', [App\Http\Controllers\Pasien\PasienAuthController::class, 'home'])->name('pasien.home');

// route untuk autentikasi akun backend (Admin & Pegawai)
Route::get('/backend/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/backend/login', [AuthController::class, 'authenticate'])
    ->name('authenticate');

Route::any('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// Lupa Password visual doank
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('password.forgot');
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordSend'])
    ->name('password.forgot.send');
Route::get('/forgot-password/verify', [AuthController::class, 'verifyOtp'])
    ->name('password.forgot.verify');
Route::post('/forgot-password/verify', [AuthController::class, 'verifyOtpCheck'])
    ->name('password.forgot.verify.check');
Route::get('/forgot-password/reset', [AuthController::class, 'resetPassword'])
    ->name('password.forgot.reset');
Route::post('/forgot-password/reset', [AuthController::class, 'resetPasswordSave'])
    ->name('password.forgot.reset.save');

Route::prefix('admin')
    ->middleware(['auth:admin'])
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
    ->middleware(['auth:pegawai'])
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

// Frontend
Route::prefix('pasien')->as('pasien.')->group(function () {
    Route::get('/welcome', [App\Http\Controllers\Pasien\PasienAuthController::class, 'welcome'])->name('welcome');
    Route::get('/layanan', [App\Http\Controllers\Pasien\PasienAuthController::class, 'layanan'])->name('layanan');
    Route::get('/layanan/umum', [App\Http\Controllers\Pasien\PasienAuthController::class, 'layananUmum'])->name('layanan.umum');
    Route::get('/cara-daftar', [App\Http\Controllers\Pasien\PasienAuthController::class, 'caraDaftar'])->name('cara-daftar');
    Route::get('/tentang-klinik', [App\Http\Controllers\Pasien\PasienAuthController::class, 'tentangKlinik'])->name('tentang-klinik');
    Route::get('/tips-kesehatan', [App\Http\Controllers\Pasien\PasienAuthController::class, 'tipsKesehatan'])->name('tips-kesehatan');
    Route::get('/tips-kesehatan/begadang', [App\Http\Controllers\Pasien\PasienAuthController::class, 'tipsKesehatanBegadang'])->name('tips-kesehatan.begadang');
    Route::get('/jadwal', [App\Http\Controllers\Pasien\PasienAuthController::class, 'jadwalDokter'])->name('jadwal');
    Route::middleware('guest:pasien')->group(function () {
        Route::get('/login', [App\Http\Controllers\Pasien\PasienAuthController::class, 'loginForm'])->name('login');
        Route::post('/login', [App\Http\Controllers\Pasien\PasienAuthController::class, 'login'])->name('login.post');
        Route::get('/register', [App\Http\Controllers\Pasien\PasienAuthController::class, 'registerForm'])->name('register');
        Route::post('/register', [App\Http\Controllers\Pasien\PasienAuthController::class, 'register'])->name('register.post');
        
        // Lupa Password Pasien visual flow
        Route::get('/forgot-password', [App\Http\Controllers\Pasien\PasienAuthController::class, 'forgotPassword'])->name('password.forgot');
        Route::post('/forgot-password', [App\Http\Controllers\Pasien\PasienAuthController::class, 'forgotPasswordSend'])->name('password.forgot.send');
        Route::get('/forgot-password/verify', [App\Http\Controllers\Pasien\PasienAuthController::class, 'verifyOtp'])->name('password.forgot.verify');
        Route::post('/forgot-password/verify', [App\Http\Controllers\Pasien\PasienAuthController::class, 'verifyOtpCheck'])->name('password.forgot.verify.check');
        Route::get('/forgot-password/reset', [App\Http\Controllers\Pasien\PasienAuthController::class, 'resetPassword'])->name('password.forgot.reset');
        Route::post('/forgot-password/reset', [App\Http\Controllers\Pasien\PasienAuthController::class, 'resetPasswordSave'])->name('password.forgot.reset.save');
    });

    Route::middleware('auth:pasien')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Pasien\PasienAuthController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [App\Http\Controllers\Pasien\PasienAuthController::class, 'logout'])->name('logout');
        Route::get('/get-schedules', [App\Http\Controllers\Pasien\PasienAuthController::class, 'getSchedules'])->name('get-schedules');
        Route::post('/pendaftaran/simpan', [App\Http\Controllers\Pasien\PasienAuthController::class, 'storePendaftaran'])->name('pendaftaran.store');
    });
});