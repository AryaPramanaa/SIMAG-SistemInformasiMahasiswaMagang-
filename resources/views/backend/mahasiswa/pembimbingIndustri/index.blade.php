@extends('backend.dashboard.mahasiswa')

@section('title', 'Daftar Pembimbing Industri')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Daftar Pembimbing Industri</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="mb-6">
            <a href="{{ route('mahasiswa.pembimbingIndustri.create') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Pembimbing
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Search and Filter Form -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <form action="{{ route('mahasiswa.pembimbingIndustri.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Cari Pembimbing</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        placeholder="Masukkan nama pembimbing">
                </div>
                <div></div>
                <div class="flex items-end space-x-2">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-medium">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari
                    </button>
                    <a href="{{ route('mahasiswa.pembimbingIndustri.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">NO</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">NAMA PEMBIMBING</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">JABATAN</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">PERUSAHAAN</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">KONTAK</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">EMAIL</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pembimbing as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $index + 1 }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $item->nama_pembimbing }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $item->jabatan }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $item->perusahaan->nama_perusahaan }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $item->kontak }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $item->email }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('mahasiswa.pembimbingIndustri.show', $item->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('mahasiswa.pembimbingIndustri.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('mahasiswa.pembimbingIndustri.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus pembimbing ini?')">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Tidak ada data pembimbing industri
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pembimbing->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $pembimbing->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
