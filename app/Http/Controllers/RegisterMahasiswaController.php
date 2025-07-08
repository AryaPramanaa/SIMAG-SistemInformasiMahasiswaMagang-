<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterMahasiswaController extends Controller
{
    public function showRegistrationForm()
    {
        $prodis = Prodi::all();
        return view('auth.register_mahasiswa', compact('prodis'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'nim' => 'required|string|unique:mahasiswas,nim',
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'status_aktif' => 'required|string',
            'alamat' => 'required|string',
            'semester' => 'required|integer',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'status' => 'Non Aktif', // default
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'status_aktif' => $request->status_aktif,
            'alamat' => $request->alamat,
            'semester' => $request->semester,
            'prodi_id' => $request->prodi_id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Akun Anda akan diaktifkan oleh operator.');
    }
} 