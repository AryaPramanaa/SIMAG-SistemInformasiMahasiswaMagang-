@extends('backend.dashboard.operator')
@section('title', 'Edit Perusahaan PKL')

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
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Perusahaan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('operator.perusahaanPKL.update', $perusahaan->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Nama Perusahaan -->
                <div>
                    <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan" id="nama_perusahaan" 
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('nama_perusahaan') border-red-500 @enderror"
                        value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan) }}" required>
                    @error('nama_perusahaan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" 
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('alamat') border-red-500 @enderror"
                        required>{{ old('alamat', $perusahaan->alamat) }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kontak -->
                <div>
                    <label for="kontak" class="block text-sm font-medium text-gray-700 mb-1">Kontak</label>
                    <input type="text" name="kontak" id="kontak" 
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('kontak') border-red-500 @enderror"
                        value="{{ old('kontak', $perusahaan->kontak) }}" required>
                    @error('kontak')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bidang Usaha -->
                <div>
                    <label for="bidang_usaha" class="block text-sm font-medium text-gray-700 mb-1">Bidang Usaha</label>
                    <input type="text" name="bidang_usaha" id="bidang_usaha" 
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('bidang_usaha') border-red-500 @enderror"
                        value="{{ old('bidang_usaha', $perusahaan->bidang_usaha) }}" required>
                    @error('bidang_usaha')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Kerjasama -->
                <div>
                    <label for="status_kerjasama" class="block text-sm font-medium text-gray-700 mb-1">Status Kerjasama</label>
                    <select name="status_kerjasama" id="status_kerjasama" 
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('status_kerjasama') border-red-500 @enderror"
                        required>
                        <option value="">Pilih Status</option>
                        <option value="Aktif" {{ old('status_kerjasama', $perusahaan->status_kerjasama) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non Aktif" {{ old('status_kerjasama', $perusahaan->status_kerjasama) == 'Non Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('status_kerjasama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-6 rounded-lg transition-colors duration-150">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection 