<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\penganjuanPKLController;
use Illuminate\Support\Facades\Route;

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
Route::resource('/pengajuanPKL', penganjuanPKLController::class);




Route::get('/dash', function(){
    return view('backend.dashboard.admin');
});


