<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\pengajuanPKLController;
use App\Http\Controllers\daftarPerusahaanController;
use App\Http\Controllers\pembimbingIndustriController;

Route::get('/', function () {
    return view('frontend.homepage');
});
Route::get('/entry', function () {
    return view('auth.entry');
});


// Login
Route::get('/dashboard/{username}', [LoginController::class, 'redirect'])->name('dashboard')->middleware();
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//pengajuanPKL
Route::resource('/pengajuanPKL', pengajuanPKLController::class);
//daftar perusahaan PKL
Route::resource('/daftarPerusahaan', daftarPerusahaanController::class);

Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::resource('daftarPerusahaanPKL', daftarPerusahaanController::class);
    Route::resource('pembimbingIndustri', pembimbingIndustriController::class);
});

Route::get('/dash', function(){
    return view('backend.dashboard.admin');
});


