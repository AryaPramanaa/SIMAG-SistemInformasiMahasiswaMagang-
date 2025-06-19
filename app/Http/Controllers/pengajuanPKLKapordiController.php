<?php

namespace App\Http\Controllers;

use App\Models\pengajuanPKL;
use App\Models\Mahasiswa;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class pengajuanPKLKapordiController extends Controller
{
    public function index()
    {
        $pengajuans = pengajuanPKL::with(['mahasiswa.prodi', 'perusahaan'])->latest()->paginate(10);
        return view('backend.kaprodi.pengajuanPKLkaprodi.index', compact('pengajuans'));
    }

    public function show($id)
    {
        $pengajuan = pengajuanPKL::with(['mahasiswa.prodi', 'mahasiswa.pembimbingAkademik', 'perusahaan'])->findOrFail($id);
        return view('backend.kaprodi.pengajuanPKLkaprodi.show', compact('pengajuan'));
    }

    public function edit($id)
    {
        $pengajuan = pengajuanPKL::with(['mahasiswa.prodi', 'perusahaan'])->findOrFail($id);
        
        // Check if pengajuan can be edited
        if ($pengajuan->status !== 'Pending') {
            return redirect()->route('kaprodi.pengajuanPKL.index')
                ->with('error', 'Pengajuan tidak dapat diedit karena status sudah ' . $pengajuan->status);
        }

        $mahasiswas = Mahasiswa::all();
        $perusahaans = Perusahaan::where('status_kerjasama', 'Aktif')->get();
        return view('backend.kaprodi.pengajuanPKLkaprodi.edit', compact('pengajuan', 'mahasiswas', 'perusahaans'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = pengajuanPKL::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Pending,Diterima,Ditolak',
            'alasan_penolakan' => 'required_if:status,Ditolak|nullable|string|max:255',
        ]);

        $data = [
            'status' => $request->status,
        ];

        if ($request->status === 'Ditolak') {
            $data['alasan_penolakan'] = $request->alasan_penolakan;
        } else {
            $data['alasan_penolakan'] = null;
        }

        $pengajuan->update($data);

        return redirect()->route('kaprodi.pengajuanPKL.index')
            ->with('success', 'Status pengajuan PKL berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajuan = pengajuanPKL::findOrFail($id);
        $pengajuan->delete();
        
        return redirect()->route('kaprodi.pengajuanPKL.index')
            ->with('success', 'Pengajuan PKL berhasil dihapus.');
    }
}
