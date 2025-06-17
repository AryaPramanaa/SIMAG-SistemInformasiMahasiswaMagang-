<?php

namespace App\Http\Controllers;

use App\Models\LowonganPKL;
use Illuminate\Http\Request;

class LowonganPKlController extends Controller
{
    public function index(Request $request)
    {
        $query = LowonganPKL::with('perusahaan');

        // Search functionality
        if ($request->has('search') && $request->search !== '') {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereHas('perusahaan', function($q) use ($search) {
                    $q->whereRaw('LOWER(nama_perusahaan) LIKE ?', ['%' . $search . '%']);
                })
                ->orWhereRaw('LOWER(divisi) LIKE ?', ['%' . $search . '%'])
                ->orWhereRaw('LOWER(deskripsi) LIKE ?', ['%' . $search . '%'])
                ->orWhereRaw('LOWER(syarat) LIKE ?', ['%' . $search . '%']);
            });
        }

        $lowonganPKLs = $query->latest()->paginate(10);
        
        if ($request->ajax()) {
            return response()->json($lowonganPKLs);
        }
        return view('backend.mahasiswa.lowonganPKL.index', compact('lowonganPKLs'));
    }
}
