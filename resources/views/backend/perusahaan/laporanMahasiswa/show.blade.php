@extends('backend.dashboard.perusahaan')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Laporan Mahasiswa Magang</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>
        <div class="mb-6">
            <a href="{{ route('perusahaan.laporanMahasiswa.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="space-y-6">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Informasi Laporan</h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Mahasiswa</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $laporan->pengajuanPKL->mahasiswa->nama ?? '-' }} ({{ $laporan->pengajuanPKL->mahasiswa->nim ?? '-' }})</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pembimbing Industri</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $laporan->pembimbingIndustri->nama_pembimbing ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Pembimbing Akademik</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $laporan->pembimbingAkademik->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Tanggal Laporan</p>
                            <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Isi Laporan</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-900">{{ $laporan->isi_laporan }}</p>
                    </div>
                </div>
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('perusahaan.laporanMahasiswa.index') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Kembali
                    </a>
                    <a href="{{ route('perusahaan.laporanMahasiswa.edit', $laporan) }}"
                        class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection 