@extends('backend.dashboard.operator')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Jadwal Pendaftaran</h1>
                <div class="w-40 h-1 bg-green-500 mx-auto"></div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Jurusan</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $jadwalPendaftaran->prodi->jurusan }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Tanggal Buka</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ \Carbon\Carbon::parse($jadwalPendaftaran->tanggal_buka)->format('d/m/Y') }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Tanggal Tutup</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ \Carbon\Carbon::parse($jadwalPendaftaran->tanggal_tutup)->format('d/m/Y') }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Tahun Akademik</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $jadwalPendaftaran->tahun_akademik }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Deskripsi</h3>
                        <p class="mt-1 text-sm text-gray-500 whitespace-pre-line">{{ $jadwalPendaftaran->deskripsi }}</p>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('operator.jadwalPendaftaran.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Kembali
                        </a>
                        <a href="{{ route('operator.jadwalPendaftaran.edit', $jadwalPendaftaran->id) }}"
                            class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 