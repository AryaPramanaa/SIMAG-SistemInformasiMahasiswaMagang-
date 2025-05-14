<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.homepage');
});
Route::get('/login1', function () {
    return view('auth.index');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard.admin');
});

Route::get('/read', function () {
    return view('backend.mahasiswa.pendaftaranPKL.index');
});

