<?php

namespace App\Http\Controllers;

use App\Models\PembimbingAkademik;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class PembimbingAkademikController extends Controller
{
    public function index()
    {
        $pembimbingAkademik = PembimbingAkademik::with('prodi')->get();
        return view('backend.kaprodi.pembimbingAkademik.index', compact('pembimbingAkademik'));
    }

    public function create()
    {
        $prodis = Prodi::all();
        return view('backend.kaprodi.pembimbingAkademik.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:pembimbing_akademik',
            'prodi_id' => 'required|exists:prodis,id',
            'kapasitas_bimbingan' => 'required|integer|min:1',
            'kontak' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        PembimbingAkademik::create($request->all());

        return redirect()->route('pembimbing-akademik.index')
            ->with('success', 'Pembimbing Akademik berhasil ditambahkan');
    }

    public function show(PembimbingAkademik $pembimbingAkademik)
    {
        $pembimbingAkademik->load(['prodi', 'mahasiswas.pengajuanpkl.perusahaan']);
        
        // Ambil semua prodi_id yang jurusannya sama dengan jurusan pembimbing akademik
        $prodiIds = \App\Models\Prodi::where('jurusan', $pembimbingAkademik->prodi->jurusan)->pluck('id');
        $availableStudents = \App\Models\Mahasiswa::whereIn('prodi_id', $prodiIds)
            ->whereHas('pengajuanpkl', function($query) {
                $query->whereRaw('LOWER(status) = ?', ['diterima']);
            })
            ->get();
        
        return view('backend.kaprodi.pembimbingAkademik.show', compact('pembimbingAkademik', 'availableStudents'));
    }

    public function edit(PembimbingAkademik $pembimbingAkademik)
    {
        $prodis = Prodi::all();
        return view('backend.kaprodi.pembimbingAkademik.edit', compact('pembimbingAkademik', 'prodis'));
    }

    public function update(Request $request, PembimbingAkademik $pembimbingAkademik)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:pembimbing_akademik,nip,' . $pembimbingAkademik->id,
            'prodi_id' => 'required|exists:prodis,id',
            'kapasitas_bimbingan' => 'required|integer|min:1',
            'kontak' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
        ]);

        $pembimbingAkademik->update($request->all());

        return redirect()->route('pembimbing-akademik.index')
            ->with('success', 'Pembimbing Akademik berhasil diperbarui');
    }

    public function destroy(PembimbingAkademik $pembimbingAkademik)
    {
        $pembimbingAkademik->delete();

        return redirect()->route('pembimbing-akademik.index')
            ->with('success', 'Pembimbing Akademik berhasil dihapus');
    }

    public function assignMahasiswa(Request $request, PembimbingAkademik $pembimbingAkademik)
    {
        $request->validate([
            'mahasiswa_ids' => 'required|array',
            'mahasiswa_ids.*' => 'exists:mahasiswas,id'
        ]);

        // Check if adding these students would exceed capacity
        $currentCount = $pembimbingAkademik->mahasiswas()->count();
        $newCount = count($request->mahasiswa_ids);
        
        if ($currentCount + $newCount > $pembimbingAkademik->kapasitas_bimbingan) {
            return back()->with('error', 'Kapasitas bimbingan akan terlampaui');
        }

        $pembimbingAkademik->mahasiswas()->attach($request->mahasiswa_ids);

        return back()->with('success', 'Mahasiswa berhasil ditambahkan ke pembimbing akademik');
    }

    public function removeMahasiswa(PembimbingAkademik $pembimbingAkademik, Mahasiswa $mahasiswa)
    {
        $pembimbingAkademik->mahasiswas()->detach($mahasiswa->id);

        return back()->with('success', 'Mahasiswa berhasil dihapus dari pembimbing akademik');
    }

    public function assignSingleMahasiswa(Request $request, PembimbingAkademik $pembimbingAkademik, \App\Models\Mahasiswa $mahasiswa)
    {
        // Cek kapasitas bimbingan
        $currentCount = $pembimbingAkademik->mahasiswas()->count();
        if ($currentCount >= $pembimbingAkademik->kapasitas_bimbingan) {
            return back()->with('error', 'Kapasitas bimbingan sudah penuh');
        }
        // Cek apakah sudah pernah di-assign
        if ($pembimbingAkademik->mahasiswas()->where('mahasiswa_id', $mahasiswa->id)->exists()) {
            return back()->with('error', 'Mahasiswa sudah dipasangkan ke pembimbing ini');
        }
        $pembimbingAkademik->mahasiswas()->attach($mahasiswa->id);
        return back()->with('success', 'Mahasiswa berhasil dipasangkan ke pembimbing akademik');
    }
} 