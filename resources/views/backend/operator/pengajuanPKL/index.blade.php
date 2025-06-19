@extends('backend.dashboard.operator')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Daftar Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Filter Form -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
            <form action="{{ route('operator.pengajuanPKL.index') }}" method="GET">
                <div class="flex flex-col md:flex-row items-end gap-6">
                    <div class="flex-1">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Mahasiswa</label>
                        <input type="text" name="nama" id="nama" value="{{ request('nama') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:border-green-500 focus:ring-green-500 focus:bg-white">
                    </div>
                    <div class="flex-1">
                        <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                        <input type="text" name="nim" id="nim" value="{{ request('nim') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:border-green-500 focus:ring-green-500 focus:bg-white">
                    </div>
                    <div class="flex-1">
                        <label for="perusahaan" class="block text-sm font-medium text-gray-700 mb-2">Perusahaan</label>
                        <input type="text" name="perusahaan" id="perusahaan" value="{{ request('perusahaan') }}" 
                            class="w-full px-4 py-2.5 rounded-lg border-gray-300 bg-gray-50 shadow-sm focus:border-green-500 focus:ring-green-500 focus:bg-white">
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('operator.pengajuanPKL.index') }}" 
                            class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Reset
                        </a>
                        <button type="submit" 
                            class="px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                NO</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                NAMA MAHASISWA</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                NIM</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                PERUSAHAAN PKL</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                TANGGAL PENGAJUAN</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                STATUS</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                DIVISI</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                                AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($pengajuans as $pengajuan)
                            <tr class="bg-white hover:bg-gray-50">
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ $loop->index + 1 }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ $pengajuan->mahasiswa->nama }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ $pengajuan->mahasiswa->nim }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ $pengajuan->perusahaan->nama_perusahaan }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d/m/Y') }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-center">
                                    <span class="px-3 py-1 rounded-full text-xs
                                        @if($pengajuan->status == 'Pending') bg-yellow-100 text-yellow-800
                                        @elseif($pengajuan->status == 'Diterima') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $pengajuan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                                    {{ $pengajuan->divisi_pilihan }}</td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('operator.pengajuanPKL.show', $pengajuan->id) }}"
                                            class="text-blue-600 hover:text-blue-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        @if($pengajuan->status == 'Pending')
                                        <a href="{{ route('operator.pengajuanPKL.edit', $pengajuan->id) }}"
                                            class="text-yellow-600 hover:text-yellow-900">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $pengajuans->links() }}
        </div>
    </div>
@endsection
