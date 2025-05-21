<?php

namespace App\Http\Controllers;

use App\Models\PembimbingIndustri;
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class pembimbingIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PembimbingIndustri::with('perusahaan');

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(nama_pembimbing) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(jabatan) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(kontak) LIKE ?', ['%' . $search . '%'])
                  ->orWhereRaw('LOWER(email) LIKE ?', ['%' . $search . '%']);
            });
        }

        $pembimbing = $query->latest()->paginate(10);
        
        if ($request->ajax()) {
            return response()->json($pembimbing);
        }

        return view('backend.mahasiswa.pembimbingIndustri.index', compact('pembimbing'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perusahaan = Perusahaan::where('status_kerjasama', 'Aktif')->get();
        return view('backend.mahasiswa.pembimbingIndustri.create', compact('perusahaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pembimbing' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        try {
            PembimbingIndustri::create($validated);

            return redirect()
                ->route('mahasiswa.pembimbingIndustri.index')
                ->with('success', 'Pembimbing industri berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambahkan pembimbing industri: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembimbing = PembimbingIndustri::with('perusahaan')->findOrFail($id);
        return view('backend.mahasiswa.pembimbingIndustri.show', compact('pembimbing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pembimbing = PembimbingIndustri::findOrFail($id);
        $perusahaan = Perusahaan::where('status_kerjasama', 'Aktif')->get();
        return view('backend.mahasiswa.pembimbingIndustri.edit', compact('pembimbing', 'perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pembimbing = PembimbingIndustri::findOrFail($id);
        
        $validated = $request->validate([
            'nama_pembimbing' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'perusahaan_id' => 'required|exists:perusahaans,id',
        ]);

        try {
            $pembimbing->update($validated);

            return redirect()
                ->route('mahasiswa.pembimbingIndustri.index')
                ->with('success', 'Pembimbing industri berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui pembimbing industri: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pembimbing = PembimbingIndustri::findOrFail($id);
            $pembimbing->delete();

            return redirect()
                ->route('mahasiswa.pembimbingIndustri.index')
                ->with('success', 'Pembimbing industri berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus pembimbing industri: ' . $e->getMessage());
        }
    }
}
