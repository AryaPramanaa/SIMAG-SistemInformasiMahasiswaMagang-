<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterMahasiswaController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register_mahasiswa');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'status' => 'Non Aktif', // default
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Akun Anda akan diaktifkan oleh operator.');
    }
} 