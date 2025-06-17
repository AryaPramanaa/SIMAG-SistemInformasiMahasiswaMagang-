@extends('backend.dashboard.operator')
@section('title', 'Detail Perusahaan PKL')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('operator.perusahaanPKL.index') }}" class="inline-flex items-center text-gray-700 hover:text-green-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span class="text-lg font-medium">Kembali</span>
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Perusahaan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <!-- Details Grid -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Informasi Perusahaan</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <p class="text-sm text-gray-600">Nama Perusahaan:</p>
                            <p class="font-medium text-gray-800">{{ $perusahaan->nama_perusahaan }}</p>
                            <p class="text-sm text-gray-600 mt-2">Bidang Usaha:</p>
                            <p class="font-medium text-gray-800">{{ $perusahaan->bidang_usaha }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Kontak</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <p class="text-sm text-gray-600">Kontak:</p>
                            <p class="font-medium text-gray-800">{{ $perusahaan->kontak }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Alamat</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <p class="text-sm text-gray-600">Alamat Lengkap:</p>
                            <p class="font-medium text-gray-800">{{ $perusahaan->alamat }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Status Kerjasama</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <p class="text-sm text-gray-600">Status:</p>
                            <p class="font-medium text-gray-800">{{ $perusahaan->status_kerjasama }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection