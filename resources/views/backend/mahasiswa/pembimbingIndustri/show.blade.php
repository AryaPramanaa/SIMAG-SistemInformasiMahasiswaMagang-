@extends('backend.dashboard.mahasiswa')

@section('title', 'Detail Pembimbing Industri')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('mahasiswa.pembimbingIndustri.index') }}" class="inline-flex items-center text-gray-700 hover:text-green-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span class="text-lg font-medium">Kembali</span>
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Pembimbing Industri</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <!-- Content Card -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Informasi Pembimbing -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Pembimbing</h2>
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Nama Pembimbing</h3>
                                    <p class="mt-1 text-lg text-gray-900">{{ $pembimbingIndustri->nama_pembimbing }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Jabatan</h3>
                                    <p class="mt-1 text-lg text-gray-900">{{ $pembimbingIndustri->jabatan }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Kontak -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kontak</h2>
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Nomor Telepon</h3>
                                    <p class="mt-1 text-lg text-gray-900">{{ $pembimbingIndustri->kontak }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Email</h3>
                                    <p class="mt-1 text-lg text-gray-900">{{ $pembimbingIndustri->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Perusahaan -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Perusahaan</h2>
                            <div class="space-y-4">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Nama Perusahaan</h3>
                                    <p class="mt-1 text-lg text-gray-900">{{ $pembimbingIndustri->perusahaan->nama_perusahaan }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Bidang Usaha</h3>
                                    <p class="mt-1 text-lg text-gray-900">{{ $pembimbingIndustri->perusahaan->bidang_usaha }}</p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500">Alamat</h3>
                                    <p class="mt-1 text-lg text-gray-900">{{ $pembimbingIndustri->perusahaan->alamat }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                    <a href="{{ route('mahasiswa.pembimbingIndustri.edit', $pembimbingIndustri->id) }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-6 rounded-lg inline-flex items-center transition-colors duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('mahasiswa.pembimbingIndustri.destroy', $pembimbingIndustri->id) }}" method="POST"
                        class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pembimbing ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white font-medium py-2 px-6 rounded-lg inline-flex items-center transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection 