<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\API\PerusahaanApiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\LowonganPKLController;
use App\Http\Controllers\pengajuanPKLController;
use App\Http\Controllers\PerusahaanPKLController;
use App\Http\Controllers\SuratPernyataanController;
use App\Http\Controllers\daftarPerusahaanController;
use App\Http\Controllers\laporanMahasiswaController;
use App\Http\Controllers\pembimbingIndustriController;
use App\Http\Controllers\JurusanProdiController;
use App\Http\Controllers\JadwalPendaftaranController;
use App\Http\Controllers\pengajuanPKLKapordiController;
use App\Http\Controllers\OperatorLowonganPKlController;
use App\Http\Controllers\PerusahaanLowonganPKLController;
use App\Http\Controllers\SuratPKLController;
use App\Http\Controllers\OperatorSuratPKLController;
use App\Http\Controllers\PembimbingAkademikController;
use App\Http\Controllers\OperatorPengajuanPKLController;


//Frontend
Route::get('/', function () {
    return view('frontend.homepage');
});
Route::get('/entry', function () {
    return view('auth.entry');
});


// Login
Route::get('/dashboard/{username}', [LoginController::class, 'redirect'])->name('dashboard')->middleware('auth');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Role-specific dashboard routes
Route::middleware(['auth'])->group(function () {
    Route::get('/perusahaan/dashboard', function () {
        return view('backend.dashboard.perusahaan');
    })->name('perusahaan.dashboard');

    Route::get('/mahasiswa/dashboard', function () {
        return view('backend.dashboard.mahasiswa');
    })->name('mahasiswa.dashboard');

    Route::get('/operator/dashboard', function () {
        return view('backend.dashboard.operator');
    })->name('operator.dashboard');

    Route::get('/kaprodi/dashboard', function () {
        return view('backend.dashboard.kaprodi');
    })->name('kaprodi.dashboard');

    Route::get('/pimpinan/dashboard', function () {
        return view('backend.dashboard.pimpinan');
    })->name('pimpinan.dashboard');

    
});



//MAHASISWA
Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::resource('daftarPerusahaanPKL', daftarPerusahaanController::class);
    Route::resource('pembimbingIndustri', pembimbingIndustriController::class);
    Route::resource('suratPernyataan', SuratPernyataanController::class);
    Route::resource('pengajuanPKL', pengajuanPKLController::class);
    Route::resource('lowonganPKL', LowonganPKLController::class);
    Route::resource('suratPKL', SuratPKLController::class);
});

//PERUSAHAAN ROUTE
Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
    Route::resource('lowonganPKL', PerusahaanLowonganPKLController::class);
});

//OPERATOR ROUTE
Route::prefix('operator')->name('operator.')->group(function () {
    Route::resource('perusahaanPKL', PerusahaanPKLController::class);
    Route::resource('jurusanProdi', JurusanProdiController::class);
    Route::resource('akun', AkunController::class);
    Route::resource('jadwalPendaftaran', JadwalPendaftaranController::class);
    Route::resource('lowonganPKL', OperatorLowonganPKlController::class);
    Route::resource('suratPKL', OperatorSuratPKLController::class);
    Route::resource('pengajuanPKL', OperatorPengajuanPKLController::class);
});

//KAPRODI
Route::prefix('kaprodi')->name('kaprodi.')->group(function () {
    Route::resource('pengajuanPKL', pengajuanPKLKapordiController::class);
});
// Pembimbing Akademik Routes
Route::prefix('kaprodi')->group(function () {
    Route::resource('pembimbing-akademik', PembimbingAkademikController::class);
    Route::post('pembimbing-akademik/{pembimbingAkademik}/assign-mahasiswa', [PembimbingAkademikController::class, 'assignMahasiswa'])->name('pembimbing-akademik.assign-mahasiswa');
    Route::delete('pembimbing-akademik/{pembimbingAkademik}/mahasiswa/{mahasiswa}', [PembimbingAkademikController::class, 'removeMahasiswa'])->name('pembimbing-akademik.remove-mahasiswa');
    Route::post('kaprodi/pembimbing-akademik/{pembimbingAkademik}/assign-mahasiswa/{mahasiswa}', [App\Http\Controllers\PembimbingAkademikController::class, 'assignSingleMahasiswa'])->name('pembimbing-akademik.assign-single-mahasiswa');
});

//API
Route::get('/data', [App\Http\Controllers\API\PerusahaanApiController::class, 'importFromJson']); 














