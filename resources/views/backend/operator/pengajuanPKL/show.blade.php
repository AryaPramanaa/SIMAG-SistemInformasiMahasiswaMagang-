@extends('backend.dashboard.operator')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Mahasiswa Information -->
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Mahasiswa</h2>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nama</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->mahasiswa->nama }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">NIM</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->mahasiswa->nim }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Program Studi</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->mahasiswa->prodi->nama_prodi }}</p>
                            </div>
                        </div>

                        <!-- Perusahaan Information -->
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Perusahaan</h2>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nama Perusahaan</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->perusahaan->nama_perusahaan }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Alamat</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->perusahaan->alamat }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Divisi</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->divisi_pilihan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Information -->
                    <div class="mt-8 border-t pt-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Status Pengajuan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Status</label>
                                <p class="mt-1">
                                    <span class="px-3 py-1 rounded-full text-xs
                                        @if($pengajuan->status == 'Pending') bg-yellow-100 text-yellow-800
                                        @elseif($pengajuan->status == 'Diterima') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $pengajuan->status }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Tanggal Pengajuan</label>
                                <p class="mt-1 text-gray-900">{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d/m/Y') }}</p>
                            </div>
                            @if($pengajuan->status == 'Ditolak')
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-600">Alasan Penolakan</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->alasan_penolakan }}</p>
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

                    <!-- Action Buttons -->
                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('operator.pengajuanPKL.index') }}" 
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Kembali
                        </a>
                        @if($pengajuan->status == 'Pending')
                        <a href="{{ route('operator.pengajuanPKL.edit', $pengajuan->id) }}" 
                            class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Update Status
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 