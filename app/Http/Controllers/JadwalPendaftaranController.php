<?php

namespace App\Http\Controllers;

use App\Models\jadwalPendfatraan;
use App\Models\Prodi;
use Illuminate\Http\Request;

class JadwalPendaftaranController extends Controller
{
    public function index()
    {
        $jadwals = jadwalPendfatraan::with('prodi')->paginate(10);
        $prodis = Prodi::select('id', 'jurusan')->distinct()->get();
        return view('backend.operator.JadwalPendaftaran.index', compact('jadwals', 'prodis'));
    }

    public function create()
    {
        $prodis = Prodi::select('id', 'jurusan')->distinct()->get();
        return view('backend.operator.JadwalPendaftaran.create', compact('prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'prodi_id' => 'required',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'tahun_akademik' => 'required',
        ]);

        if ($request->prodi_id === 'all') {
            // Create schedule for all jurusan
            $prodis = Prodi::select('id', 'jurusan')->distinct()->get();
            foreach ($prodis as $prodi) {
                jadwalPendfatraan::create([
                    'prodi_id' => $prodi->id,
                    'tanggal_buka' => $request->tanggal_buka,
                    'tanggal_tutup' => $request->tanggal_tutup,
                    'tahun_akademik' => $request->tahun_akademik,
                    'deskripsi' => $request->deskripsi,
                ]);
            }
        } else {
            // Create schedule for single jurusan
            jadwalPendfatraan::create($request->all());
        }

        return redirect()->route('operator.jadwalPendaftaran.index')
            ->with('success', 'Jadwal pendaftaran berhasil ditambahkan');
    }

    public function show(jadwalPendfatraan $jadwalPendaftaran)
    {
        return view('backend.operator.JadwalPendaftaran.show', compact('jadwalPendaftaran'));
    }

    public function edit(jadwalPendfatraan $jadwalPendaftaran)
    {
        $prodis = Prodi::select('id', 'jurusan')->distinct()->get();
        return view('backend.operator.JadwalPendaftaran.edit', compact('jadwalPendaftaran', 'prodis'));
    }

    public function update(Request $request, jadwalPendfatraan $jadwalPendaftaran)
    {
        $request->validate([
            'prodi_id' => 'required',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'tahun_akademik' => 'required',
        ]);

        $jadwalPendaftaran->update($request->all());

        return redirect()->route('operator.jadwalPendaftaran.index')
            ->with('success', 'Jadwal pendaftaran berhasil diperbarui');
    }

    public function destroy(jadwalPendfatraan $jadwalPendaftaran)
    {
        $jadwalPendaftaran->delete();

        return redirect()->route('operator.jadwalPendaftaran.index')
            ->with('success', 'Jadwal pendaftaran berhasil dihapus');
    }
}
