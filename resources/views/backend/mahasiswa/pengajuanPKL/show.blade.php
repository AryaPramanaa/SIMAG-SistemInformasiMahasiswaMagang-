@extends('backend.dashboard.admin')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('pengajuanPKL.index') }}" class="inline-flex items-center text-gray-700 hover:text-green-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span class="text-lg font-medium">Kembali</span>
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <!-- Status Badge -->
            <div class="flex justify-end mb-6">
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($pengajuan->status == 'Pending') bg-yellow-100 text-yellow-800
                    @elseif($pengajuan->status == 'Diterima') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ $pengajuan->status }}
                </span>
            </div>

            <!-- Details Grid -->
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Data Mahasiswa</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <p class="text-sm text-gray-600">Nama:</p>
                            <p class="font-medium text-gray-800">{{ $pengajuan->mahasiswa->nama }}</p>
                            <p class="text-sm text-gray-600 mt-2">NIM:</p>
                            <p class="font-medium text-gray-800">{{ $pengajuan->mahasiswa->nim }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Data Perusahaan</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                            <p class="text-sm text-gray-600">Nama Perusahaan:</p>
                            <p class="font-medium text-gray-800">{{ $pengajuan->perusahaan->nama_perusahaan }}</p>
                            <p class="text-sm text-gray-600 mt-2">Alamat:</p>
                            <p class="font-medium text-gray-800">{{ $pengajuan->perusahaan->alamat }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Informasi PKL</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                            <div>
                                <p class="text-sm text-gray-600">Tanggal Pengajuan:</p>
                                <p class="font-medium text-gray-800">{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d F Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Divisi Pilihan:</p>
                                <p class="font-medium text-gray-800">{{ $pengajuan->divisi_pilihan }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Dokumen</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <a href="{{ Storage::url($pengajuan->surat_pengantar_path) }}" 
                               class="inline-flex items-center text-green-600 hover:text-green-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download Surat Pengantar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 mt-8 pt-6 border-t">
                <a href="{{ route('pengajuanPKL.edit', $pengajuan->id) }}" 
                    class="px-6 py-3 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 font-medium">
                    Edit Pengajuan
                </a>
                <form action="{{ route('pengajuanPKL.destroy', $pengajuan->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?')"
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 font-medium">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection 