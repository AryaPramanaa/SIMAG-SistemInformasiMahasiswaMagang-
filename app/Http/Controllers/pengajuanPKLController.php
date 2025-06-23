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
        $mahasiswa = Mahasiswa::where('email',Auth::user()->email)->get();

        $pengajuans = pengajuanPKL::where('mahasiswa_id',$mahasiswa[0]->id)->with(['mahasiswa', 'perusahaan'])->latest()->paginate(10);
        return view('backend.mahasiswa.pengajuanPKL.index', compact('pengajuans'));
    }

    public function create(Request $request)
    {
        $mahasiswas = Mahasiswa::where('email', Auth::user()->email)->get();
        $perusahaans = Perusahaan::where('status_kerjasama', 'Aktif')->get();

        $selectedLowongan = null;
        if ($request->has('lowongan_id')) {
            $selectedLowongan = \App\Models\LowonganPKL::with('perusahaan')->find($request->lowongan_id);
        }

        return view('backend.mahasiswa.pengajuanPKL.create', compact('mahasiswas', 'perusahaans', 'selectedLowongan'));
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
            ]);

            $data = [
                'mahasiswa_id' => $request->mahasiswa_id,
                'perusahaan_id' => $request->perusahaan_id,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'divisi_pilihan' => $request->divisi_pilihan,
                'status' => 'Pending'
            ];

            pengajuanPKL::create($data);

            // Kurangi kuota lowongan PKL jika ada
            $lowongan = \App\Models\LowonganPKL::find($request->perusahaan_id);
            if ($lowongan && !is_null($lowongan->kuota) && $lowongan->kuota > 0) {
                $lowongan->kuota = $lowongan->kuota - 1;
                $lowongan->save();
            }

            return redirect()->route('mahasiswa.pengajuanPKL.index')
                ->with('success', 'Pengajuan PKL berhasil dibuat.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $pengajuan = pengajuanPKL::with(['mahasiswa.pembimbingAkademik', 'perusahaan'])->findOrFail($id);
        $pembimbingIndustriTerpilih = $pengajuan->mahasiswa->pembimbingIndustri()->wherePivot('pengajuan_pkl_id', $pengajuan->id)->get();
        $pembimbingIndustriTersedia = [];
        if ($pengajuan->status === 'Diterima') {
            $pembimbingIndustriTersedia = \App\Models\PembimbingIndustri::where('perusahaan_id', $pengajuan->perusahaan_id)->get();
        }
        return view('backend.mahasiswa.pengajuanPKL.show', compact('pengajuan', 'pembimbingIndustriTerpilih', 'pembimbingIndustriTersedia'));
    }

    // Endpoint untuk menyimpan pembimbing industri yang dipilih mahasiswa setelah pengajuan diterima
    public function pilihPembimbingIndustri(Request $request, $pengajuanId)
    {
        $request->validate([
            'pembimbing_industri_ids' => 'required|array',
            'pembimbing_industri_ids.*' => 'exists:pembimbingIndustris,id',
        ]);
        $pengajuan = pengajuanPKL::findOrFail($pengajuanId);
        $mahasiswa = $pengajuan->mahasiswa;
        // Hanya boleh memilih jika status diterima
        if ($pengajuan->status !== 'Diterima') {
            return back()->with('error', 'Hanya bisa memilih pembimbing industri jika pengajuan sudah diterima.');
        }
        // Sync pembimbing industri untuk pengajuan ini
        $syncData = [];
        foreach ($request->pembimbing_industri_ids as $id) {
            $syncData[$id] = ['pengajuan_pkl_id' => $pengajuan->id];
        }
        $mahasiswa->pembimbingIndustri()->syncWithoutDetaching($syncData);
        return back()->with('success', 'Pembimbing industri berhasil dipilih.');
    }

    public function edit($id)
    {
        $pengajuan = pengajuanPKL::findOrFail($id);
        
        // Check if pengajuan can be edited
        if ($pengajuan->status !== 'Pending') {
            return redirect()->route('mahasiswa.pengajuanPKL.index')
                ->with('error', 'Pengajuan tidak dapat diedit karena status sudah ' . $pengajuan->status);
        }

        $mahasiswas = Mahasiswa::all();
        $perusahaans = Perusahaan::where('status_kerjasama', 'Aktif')->get();
        return view('backend.mahasiswa.pengajuanPKL.edit', compact('pengajuan', 'mahasiswas', 'perusahaans'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = pengajuanPKL::findOrFail($id);

        // Check if pengajuan can be edited
        if ($pengajuan->status !== 'Pending') {
            return redirect()->route('mahasiswa.pengajuanPKL.index')
                ->with('error', 'Pengajuan tidak dapat diedit karena status sudah ' . $pengajuan->status);
        }

        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswas,id',
            'perusahaan_id' => 'required|exists:perusahaans,id',
            'tanggal_pengajuan' => 'required|date',
            'divisi_pilihan' => 'required|string|max:255',
        ]);

        $data = [
            'mahasiswa_id' => $request->mahasiswa_id,
            'perusahaan_id' => $request->perusahaan_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'divisi_pilihan' => $request->divisi_pilihan,
        ];

        $pengajuan->update($data);

        return redirect()->route('mahasiswa.pengajuanPKL.index')
            ->with('success', 'Pengajuan PKL berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajuan = pengajuanPKL::findOrFail($id);
        $pengajuan->delete();
        
        return redirect()->route('mahasiswa.pengajuanPKL.index')
            ->with('success', 'Pengajuan PKL berhasil dihapus.');
    }
} 