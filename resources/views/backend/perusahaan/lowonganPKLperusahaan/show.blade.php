@extends('backend.dashboard.perusahaan')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Lowongan PKL</h1>
                <div class="w-40 h-1 bg-green-500 mx-auto"></div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 space-y-6">
                <!-- Divisi -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Divisi</h3>
                    <p class="mt-1 text-sm text-gray-500">{{ $lowonganPKL->divisi }}</p>
                </div>

                <!-- Deskripsi -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Deskripsi</h3>
                    <p class="mt-1 text-sm text-gray-500 whitespace-pre-line">{{ $lowonganPKL->deskripsi }}</p>
                </div>

                <!-- Syarat -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Syarat</h3>
                    <p class="mt-1 text-sm text-gray-500 whitespace-pre-line">{{ $lowonganPKL->syarat }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-4">
                    <a href="{{ route('perusahaan.lowonganPKL.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Kembali
                    </a>
                    <a href="{{ route('perusahaan.lowonganPKL.edit', $lowonganPKL->id) }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Edit
                    </a>
                    <form action="{{ route('perusahaan.lowonganPKL.destroy', $lowonganPKL->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus lowongan ini?')">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
