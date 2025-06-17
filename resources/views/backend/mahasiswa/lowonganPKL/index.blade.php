@extends('backend.dashboard.mahasiswa')
@section('title', 'Lowongan PKL')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Lowongan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex flex-wrap justify-between items-end gap-4">
                <form action="{{ route('mahasiswa.lowonganPKL.index') }}" method="GET" class="flex flex-wrap gap-4 flex-1">
                    <div class="flex-1 min-w-[200px]">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                        <div class="relative">
                            <input type="text" id="search" name="search"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                placeholder="Cari lowongan..." value="{{ request('search') }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-auto flex items-end gap-2">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-150">
                            Cari
                        </button>
                        <a href="{{ route('mahasiswa.lowonganPKL.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-150 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Refresh
                        </a>
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                NO</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                PERUSAHAAN</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                DIVISI</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                DESKRIPSI</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                SYARAT</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($lowonganPKLs as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ $index + 1 }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ $item->perusahaan->nama_perusahaan }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ $item->divisi }}</td>
                                <td class="px-6 py-5 text-sm font-semibold text-gray-500 text-center">
                                    {{ Str::limit($item->deskripsi, 50) }}</td>
                                <td class="px-6 py-5 text-sm font-semibold text-gray-500 text-center">
                                    {{ Str::limit($item->syarat, 50) }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('mahasiswa.lowonganPKL.show', $item->id) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    Tidak ada data lowongan PKL
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($lowonganPKLs->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $lowonganPKLs->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
