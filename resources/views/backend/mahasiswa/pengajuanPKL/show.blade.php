@extends('backend.dashboard.mahasiswa')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="mb-6">
            <a href="{{ route('mahasiswa.pengajuanPKL.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Mahasiswa</label>
                    <p class="text-sm text-gray-900">{{ $pengajuan->mahasiswa->nama }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                    <p class="text-sm text-gray-900">{{ $pengajuan->mahasiswa->nim }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                    <p class="text-sm text-gray-900">{{ $pengajuan->mahasiswa->prodi->nama_prodi }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Perusahaan</label>
                    <p class="text-sm text-gray-900">{{ $pengajuan->perusahaan->nama_perusahaan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Divisi</label>
                    <p class="text-sm text-gray-900">{{ $pengajuan->divisi_pilihan }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengajuan</label>
                    <p class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengajuan)->format('d/m/Y') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <p class="text-sm">
                        <span class="px-3 py-1 rounded-full text-xs
                            @if($pengajuan->status == 'Pending') bg-yellow-100 text-yellow-800
                            @elseif($pengajuan->status == 'Diterima') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $pengajuan->status }}
                        </span>
                    </p>
                </div>

                @if($pengajuan->status == 'Ditolak')
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                    <p class="text-sm text-gray-900">{{ $pengajuan->alasan_penolakan }}</p>
                </div>
                @endif
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

            @if($pengajuan->status == 'Pending')
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('mahasiswa.pengajuanPKL.edit', $pengajuan->id) }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('mahasiswa.pengajuanPKL.destroy', $pengajuan->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 font-medium"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
@endsection 