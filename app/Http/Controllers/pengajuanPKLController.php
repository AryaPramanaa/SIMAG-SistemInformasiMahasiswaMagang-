<?php

namespace App\Http\Controllers;

use App\Models\pengajuanPKL;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class pengajuanPKLController extends Controller
{
    public function index()
    {
        $pengajuans = pengajuanPKL::with(['mahasiswa', 'perusahaan'])->latest()->paginate(10);
        return view('backend.mahasiswa.pengajuanPKL.index', compact('pengajuans'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        $perusahaans = Perusahaan::where('status_kerjasama', 'Aktif')->get();
        return view('backend.mahasiswa.pengajuanPKL.create', compact('mahasiswas', 'perusahaans'));
    }

    public function store(Request $request)
    {
        try {
            // Check if mahasiswa already has a submission
            $existingSubmission = pengajuanPKL::where('mahasiswa_id', $request->mahasiswa_id)->first();
            if ($existingSubmission) {
                return back()->withErrors(['error' => 'Pengajuan melebihi batas. Setiap mahasiswa hanya diperbolehkan mengajukan 1 kali.'])->withInput();
            }

            $request->validate([
                'mahasiswa_id' => 'required|exists:mahasiswas,id',
                'perusahaan_id' => 'required|exists:perusahaans,id',
                'tanggal_pengajuan' => 'required|date',
                'divisi_pilihan' => 'required|string|max:255',
                'surat_pengantar_path' => 'required|file|mimes:pdf,doc,docx|max:10240',
            ]);

            if ($request->hasFile('surat_pengantar_path')) {
                $file = $request->file('surat_pengantar_path');
                $filename = time() . '_' . $file->getClientOriginalName();
                
                // Store file in public disk with public visibility
                $path = $file->storeAs('surat_pengantar', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Gagal menyimpan file surat pengantar');
                }

                pengajuanPKL::create([
                    'mahasiswa_id' => $request->mahasiswa_id,
                    'perusahaan_id' => $request->perusahaan_id,
                    'tanggal_pengajuan' => $request->tanggal_pengajuan,
                    'divisi_pilihan' => $request->divisi_pilihan,
                    'surat_pengantar_path' => $path,
                    'status' => 'Pending'
                ]);

                return redirect()->route('pengajuanPKL.index')
                    ->with('success', 'Pengajuan PKL berhasil dibuat.');
            } else {
                return back()->withErrors(['surat_pengantar_path' => 'File surat pengantar harus diupload'])->withInput();
            }
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $pengajuan = pengajuanPKL::with(['mahasiswa', 'perusahaan'])->findOrFail($id);
        return view('backend.mahasiswa.pengajuanPKL.show', compact('pengajuan'));
    }

    public function edit($id)
    {
        $pengajuan = pengajuanPKL::findOrFail($id);
        $mahasiswas = Mahasiswa::all();
        $perusahaans = Perusahaan::where('status_kerjasama', 'Aktif')->get();
        return view('backend.mahasiswa.pengajuanPKL.edit', compact('pengajuan', 'mahasiswas', 'perusahaans'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = pengajuanPKL::findOrFail($id);

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'tanggal_pengajuan' => 'required|date',
            'divisi_pilihan' => 'required|string|max:255',
            'surat_pengantar_path' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $data = [
            'mahasiswa_id' => $request->mahasiswa_id,
            'perusahaan_id' => $request->perusahaan_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'divisi_pilihan' => $request->divisi_pilihan,
            'status' => $request->status ?? $pengajuan->status,
        ];

        if ($request->hasFile('surat_pengantar_path')) {
            $file = $request->file('surat_pengantar_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/surat_pengantar', $filename);
            $data['surat_pengantar_path'] = 'surat_pengantar/' . $filename;

            // Delete old file if exists
            if ($pengajuan->surat_pengantar_path) {
                Storage::delete('public/' . $pengajuan->surat_pengantar_path);
            }
        }

        $pengajuan->update($data);

        return redirect()->route('pengajuanPKL.index')
            ->with('success', 'Pengajuan PKL berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajuan = pengajuanPKL::findOrFail($id);
        
        // Delete associated file if exists
        if ($pengajuan->surat_pengantar_path) {
            Storage::delete('public/' . $pengajuan->surat_pengantar_path);
        }

        $pengajuan->delete();
        
        return redirect()->route('pengajuanPKL.index')
            ->with('success', 'Pengajuan PKL berhasil dihapus.');
    }
} 