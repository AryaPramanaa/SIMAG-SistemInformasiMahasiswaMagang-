@extends('backend.dashboard.perusahaan')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Tambah Lowongan PKL</h1>
                <div class="w-40 h-1 bg-green-500 mx-auto"></div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('perusahaan.lowonganPKL.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <!-- Divisi -->
                        <div>
                            <label for="divisi" class="block text-sm font-medium text-gray-700">Divisi</label>
                            <input type="text" name="divisi" id="divisi" value="{{ old('divisi') }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                            @error('divisi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="4" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Syarat -->
                        <div>
                            <label for="syarat" class="block text-sm font-medium text-gray-700">Syarat</label>
                            <textarea name="syarat" id="syarat" rows="4" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">{{ old('syarat') }}</textarea>
                            @error('syarat')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('perusahaan.lowonganPKL.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
