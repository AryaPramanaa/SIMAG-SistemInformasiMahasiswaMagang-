<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaProfilController extends Controller
{
    public function edit()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }
        $prodis = Prodi::all();
        return view('backend.mahasiswa.profil.edit', compact('mahasiswa', 'prodis'));
    }

    public function update(Request $request)
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }
        
        $validated = $request->validate([
            'nim' => 'required|string|max:50|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'status_aktif' => 'required|in:Aktif,Non-Aktif',
            'alamat' => 'required|string',
            'semester' => 'required|integer|min:1|max:14',
            'ktm' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        try {
            // Handle KTM file upload if provided
            if ($request->hasFile('ktm')) {
                // Delete old KTM file if exists
                if ($mahasiswa->ktm && Storage::exists($mahasiswa->ktm)) {
                    Storage::delete($mahasiswa->ktm);
                }
                
                $ktmFile = $request->file('ktm');
                $ktmFileName = time() . '_' . $request->nim . '_KTM.' . $ktmFile->getClientOriginalExtension();
                $ktmPath = $ktmFile->storeAs('public/ktm', $ktmFileName);
                $validated['ktm'] = $ktmPath;
            }

            $mahasiswa->update($validated);
            return redirect()->route('mahasiswa.profil.edit')->with('success', 'Profil mahasiswa berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
