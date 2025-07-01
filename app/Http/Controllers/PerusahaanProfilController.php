<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerusahaanProfilController extends Controller
{
    public function edit()
    {
        $perusahaan = Perusahaan::where('user_id', Auth::id())->first();
        
        if (!$perusahaan) {
            return redirect()->back()->with('error', 'Data perusahaan tidak ditemukan.');
        }
        
        return view('backend.perusahaan.profil.edit', compact('perusahaan'));
    }

    public function update(Request $request)
    {
        $perusahaan = Perusahaan::where('user_id', Auth::id())->first();
        
        if (!$perusahaan) {
            return redirect()->back()->with('error', 'Data perusahaan tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255|unique:perusahaans,nama_perusahaan,' . $perusahaan->id,
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:255',
            'bidang_usaha' => 'required|string|max:255',
            'status_kerjasama' => 'required|in:Aktif,Tidak Aktif',
        ]);

        try {
            $perusahaan->update($validated);
            return redirect()->route('perusahaan.profil.edit')->with('success', 'Profil perusahaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
