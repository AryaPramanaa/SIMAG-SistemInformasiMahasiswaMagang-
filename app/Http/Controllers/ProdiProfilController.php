<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class ProdiProfilController extends Controller
{
    public function edit()
    {
        $prodi = Prodi::where('user_id', Auth::id())->first();

        // Jika belum ada, cari berdasarkan nama_kaprodi, lalu update user_id
        if (!$prodi) {
            $prodi = Prodi::where('nama_kaprodi', Auth::user()->username)->first();
            if ($prodi) {
                $prodi->user_id = Auth::id();
                $prodi->save();
            }
        }

        if (!$prodi) {
            return redirect()->back()->with('error', 'Data prodi tidak ditemukan.');
        }
        return view('backend.kaprodi.profil.edit', compact('prodi'));
    }

    public function update(Request $request)
    {
        $prodi = Prodi::where('user_id', Auth::id())->first();

        // Jika belum ada, cari berdasarkan nama_kaprodi, lalu update user_id
        if (!$prodi) {
            $prodi = Prodi::where('nama_kaprodi', Auth::user()->username)->first();
            if ($prodi) {
                $prodi->user_id = Auth::id();
                $prodi->save();
            }
        }

        if (!$prodi) {
            return redirect()->back()->with('error', 'Data prodi tidak ditemukan.');
        }
        $validated = $request->validate([
            'nama_prodi' => 'required|string|max:255|unique:prodis,nama_prodi,' . $prodi->id,
            'nama_kaprodi' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
        ]);
        $validated['user_id'] = Auth::id();
        try {
            $prodi->update($validated);
            return redirect()->route('kaprodi.profil.edit')->with('success', 'Profil prodi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
