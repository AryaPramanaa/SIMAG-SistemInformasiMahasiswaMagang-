<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class akunController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search by username or nomor_unik
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('nomor_unik', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->has('role') && $request->role !== '') {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $users = $query->latest()->paginate(10)->withQueryString();
        return view('backend.operator.Akun.index', compact('users'));
    }

    public function create()
    {
        return view('backend.operator.Akun.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'nomor_unik' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:mahasiswa,perusahaan,kaprodi,pimpinan,operator',
            'status' => 'required|string|in:Aktif,Non-Aktif',
        ]);

        User::create([
            'username' => $request->username,
            'nomor_unik' => $request->nomor_unik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('operator.akun.index')
            ->with('success', 'Akun berhasil ditambahkan');
    }

    public function edit(User $akun)
    {
        return view('backend.operator.Akun.edit', compact('akun'));
    }

    public function show(User $akun)
    {
        return view('backend.operator.Akun.show', compact('akun'));
    }

    public function update(Request $request, User $akun)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $akun->id,
            'nomor_unik' => 'required|string|max:255|unique:users,nomor_unik,' . $akun->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $akun->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:mahasiswa,perusahaan,kaprodi,pimpinan,operator',
            'status' => 'required|string|in:Aktif,Non-Aktif',
        ]);

        $data = [
            'username' => $request->username,
            'nomor_unik' => $request->nomor_unik,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $akun->update($data);

        return redirect()->route('operator.akun.index')
            ->with('success', 'Akun berhasil diperbarui');
    }

    public function destroy(User $akun)
    {
        $akun->delete();

        return redirect()->route('operator.akun.index')
            ->with('success', 'Akun berhasil dihapus');
    }
}
