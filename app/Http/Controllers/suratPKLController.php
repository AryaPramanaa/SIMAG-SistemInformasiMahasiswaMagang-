<?php

namespace App\Http\Controllers;

use App\Models\SuratPKL;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SuratPKLController extends Controller
{
    public function index()
    {
        $suratPKL = SuratPKL::with('perusahaan')->latest()->get();
        return view('backend.mahasiswa.suratPKL.index', compact('suratPKL'));
    }

    public function create()
    {
        $perusahaans = Perusahaan::where('status_kerjasama', 'aktif')->get();
        return view('backend.mahasiswa.suratPKL.create', compact('perusahaans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'nomor_surat' => 'required|string',
            'jenis_surat' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:10240' // 10MB max size, PDF only
        ]);

        $file = $request->file('file');
        $filePath = $file->store('surat_pkl', 'public');

        SuratPKL::create([
            'perusahaan_id' => $request->perusahaan_id,
            'nomor_surat' => $request->nomor_surat,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_upload' => Carbon::now(),
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath
        ]);

        return redirect()->route('mahasiswa.suratPKL.index')
            ->with('success', 'Surat PKL berhasil ditambahkan');
    }

    public function show(SuratPKL $suratPKL)
    {
        return view('backend.mahasiswa.suratPKL.show', compact('suratPKL'));
    }

    public function edit(SuratPKL $suratPKL)
    {
        $perusahaans = Perusahaan::where('status', 'aktif')->get();
        return view('backend.mahasiswa.suratPKL.edit', compact('suratPKL', 'perusahaans'));
    }

    public function update(Request $request, SuratPKL $suratPKL)
    {
        $request->validate([
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'nomor_surat' => 'required|string',
            'jenis_surat' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:10240' // 10MB max size, PDF only
        ]);

        $data = [
            'perusahaan_id' => $request->perusahaan_id,
            'nomor_surat' => $request->nomor_surat,
            'jenis_surat' => $request->jenis_surat,
            'tanggal_upload' => Carbon::now(),
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            if ($suratPKL->file_path) {
                Storage::disk('public')->delete($suratPKL->file_path);
            }
            
            $file = $request->file('file');
            $data['file_path'] = $file->store('surat_pkl', 'public');
        }

        $suratPKL->update($data);

        return redirect()->route('mahasiswa.suratPKL.index')
            ->with('success', 'Surat PKL berhasil diperbarui');
    }

    public function destroy(SuratPKL $suratPKL)
    {
        if ($suratPKL->file_path) {
            Storage::disk('public')->delete($suratPKL->file_path);
        }
        
        $suratPKL->delete();

        return redirect()->route('mahasiswa.suratPKL.index')
            ->with('success', 'Surat PKL berhasil dihapus');
    }
}
