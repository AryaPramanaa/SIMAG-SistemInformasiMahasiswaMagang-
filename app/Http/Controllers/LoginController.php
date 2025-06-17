<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Check if user exists and is not non-active
        $user = User::where('username', $credentials['username'])->first();
        
        if ($user && $user->status === 'Non-Aktif') {
            return back()->withErrors([
                'username' => 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.',
            ])->onlyInput('username');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/' . Auth::user()->username);
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }

    public function redirect($username)
    {
        if (!Auth::check()) {
            return redirect('/entry');
        }

        $user = Auth::user();
        
        if ($user->username !== $username) {
            return redirect('/entry');
        }

        switch ($user->role) {
            case 'perusahaan':
                return redirect()->route('perusahaan.dashboard');
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard');
            case 'operator':
                return redirect()->route('operator.dashboard');
            case 'kaprodi':
                return redirect()->route('kaprodi.dashboard');
            case 'administrasi':
                return redirect()->route('administrasi.dashboard');
            case 'pimpinan':
                return redirect()->route('pimpinan.dashboard');
            default:
                return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
