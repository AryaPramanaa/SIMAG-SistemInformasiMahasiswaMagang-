@extends('backend.dashboard.operator')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="mb-6">
            <a href="{{ route('operator.pengajuanPKL.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Mahasiswa Information -->
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Mahasiswa</h2>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nama</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="{{ $pengajuan->mahasiswa->nama }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">NIM</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="{{ $pengajuan->mahasiswa->nim }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Program Studi</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="{{ $pengajuan->mahasiswa->prodi->nama_prodi }}" readonly>
                            </div>
                        </div>

                        <!-- Perusahaan Information -->
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Perusahaan</h2>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Nama Perusahaan</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="{{ $pengajuan->perusahaan->nama_perusahaan }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="{{ $pengajuan->perusahaan->alamat }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Divisi</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="{{ $pengajuan->divisi_pilihan }}" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Status Information -->
                    <div class="mt-8 border-t pt-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Status Pengajuan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100 @if($pengajuan->status == 'Pending') text-yellow-800 @elseif($pengajuan->status == 'Diterima') text-green-800 @else text-red-800 @endif" value="{{ $pengajuan->status }}" readonly>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Pengajuan</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" value="{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d/m/Y') }}" readonly>
                            </div>
                            @if($pengajuan->status == 'Ditolak')
                            <div class="md:col-span-2 mt-6">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Alasan Penolakan</label>
                                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" rows="3" readonly>{{ $pengajuan->alasan_penolakan }}</textarea>
                            </div>
                            @endif
                        </div>
                    </div>

                    @if($pengajuan->status == 'Diterima')
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pembimbing Akademik</label>
                            @if($pengajuan->mahasiswa->pembimbingAkademik && $pengajuan->mahasiswa->pembimbingAkademik->count())
                                <ul class="list-disc pl-5">
                                    @foreach($pengajuan->mahasiswa->pembimbingAkademik as $pembimbing)
                                        <li class="text-sm text-gray-900">{{ $pembimbing->nama }} (NIP: {{ $pembimbing->nip ?? '-' }})</li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-sm text-gray-500">Belum ada pembimbing akademik yang dipasangkan.</p>
                            @endif
                        </div>
                    @endif

                    <!-- Action Button -->
                    <div class="mt-8 flex justify-end">
                        <!-- Hanya tombol kembali, update status dihilangkan agar konsisten -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 