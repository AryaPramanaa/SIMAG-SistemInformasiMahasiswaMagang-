<?php

namespace App\Http\Controllers;

use App\Models\SuratPernyataan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratPernyataanController extends Controller
{
    public function index()
    {
        $suratPernyataan = SuratPernyataan::with('perusahaan')->get();
        return view('backend.mahasiswa.suratPernyataan.index', compact('suratPernyataan'));
    }

    public function create()
    {
        $perusahaan = Perusahaan::all();
        return view('backend.mahasiswa.suratPernyataan.create', compact('perusahaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'tanggal_upload' => 'required|date',
            'surat_pernyataan' => 'required|file|mimes:pdf|max:10240', // 10MB
            'deskripsi' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:100',
        ]);

        $filename = null;
        if ($request->hasFile('surat_pernyataan')) {
            $file = $request->file('surat_pernyataan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/surat_pernyataan', $filename);
        }

        SuratPernyataan::create([
            'perusahaan_id' => $request->perusahaan_id,
            'tanggal_upload' => $request->tanggal_upload,
            'surat_pernyataan' => $filename,
            'deskripsi' => $request->deskripsi,
            'jenis_surat' => $request->jenis_surat,
        ]);

        return redirect()->route('mahasiswa.suratPernyataan.index')
            ->with('success', 'Surat pernyataan berhasil ditambahkan');
    }

    public function show(SuratPernyataan $suratPernyataan)
    {
        return view('backend.mahasiswa.suratPernyataan.show', compact('suratPernyataan'));
    }

    public function edit(SuratPernyataan $suratPernyataan)
    {
        $perusahaan = Perusahaan::all();
        return view('backend.mahasiswa.suratPernyataan.edit', compact('suratPernyataan', 'perusahaan'));
    }

    public function update(Request $request, SuratPernyataan $suratPernyataan)
    {
        $request->validate([
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'tanggal_upload' => 'required|date',
            'surat_pernyataan' => 'nullable|file|mimes:pdf|max:10240', // 10MB
            'deskripsi' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:100',
        ]);

        if ($request->hasFile('surat_pernyataan')) {
            // Hapus file lama
            if ($suratPernyataan->surat_pernyataan) {
                Storage::delete('public/surat_pernyataan/' . $suratPernyataan->surat_pernyataan);
            }

            // Upload file baru
            $file = $request->file('surat_pernyataan');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/surat_pernyataan', $filename);

            $suratPernyataan->surat_pernyataan = $filename;
        }

        $suratPernyataan->update([
            'perusahaan_id' => $request->perusahaan_id,
            'tanggal_upload' => $request->tanggal_upload,
            'deskripsi' => $request->deskripsi,
            'jenis_surat' => $request->jenis_surat,
        ]);

        return redirect()->route('mahasiswa.suratPernyataan.index')
            ->with('success', 'Surat pernyataan berhasil diperbarui');
    }

    public function destroy(SuratPernyataan $suratPernyataan)
    {
        // Hapus file dari storage
        if ($suratPernyataan->surat_pernyataan) {
            Storage::delete('public/surat_pernyataan/' . $suratPernyataan->surat_pernyataan);
        }

        $suratPernyataan->delete();

        return redirect()->route('mahasiswa.suratPernyataan.index')
            ->with('success', 'Surat pernyataan berhasil dihapus');
    }
} 