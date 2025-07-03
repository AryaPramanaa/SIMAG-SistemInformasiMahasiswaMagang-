<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
            $user = \Illuminate\Support\Facades\Auth::user();
            if ($user->role === 'mahasiswa' && $user->status !== 'Aktif') {
                \Illuminate\Support\Facades\Auth::logout();
                return back()->withErrors(['Akun Anda belum aktif. Silakan hubungi operator.']);
            }
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/' . $user->username);
        }
        return back()->withErrors([
            'username' => 'Username atau password salah',
        ]);
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
