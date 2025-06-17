@extends('backend.dashboard.mahasiswa')

@section('title', 'Edit Pembimbing Industri')

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
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Pembimbing Industri</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <!-- Form Card -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <form action="{{ route('mahasiswa.pembimbingIndustri.update', $pembimbingIndustri->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Nama Pembimbing -->
                    <div>
                        <label for="nama_pembimbing" class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Pembimbing <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_pembimbing" id="nama_pembimbing"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('nama_pembimbing') border-red-500 @enderror"
                            value="{{ old('nama_pembimbing', $pembimbingIndustri->nama_pembimbing) }}" required>
                        @error('nama_pembimbing')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="jabatan" id="jabatan"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('jabatan') border-red-500 @enderror"
                            value="{{ old('jabatan', $pembimbingIndustri->jabatan) }}" required>
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Perusahaan -->
                    <div>
                        <label for="perusahaan_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <select name="perusahaan_id" id="perusahaan_id"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('perusahaan_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Perusahaan</option>
                            @foreach($perusahaan as $item)
                                <option value="{{ $item->id }}" 
                                    {{ old('perusahaan_id', $pembimbingIndustri->perusahaan_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                        @error('perusahaan_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kontak -->
                    <div>
                        <label for="kontak" class="block text-sm font-medium text-gray-700 mb-1">
                            Kontak <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="kontak" id="kontak"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('kontak') border-red-500 @enderror"
                            value="{{ old('kontak', $pembimbingIndustri->kontak) }}" required>
                        @error('kontak')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('email') border-red-500 @enderror"
                            value="{{ old('email', $pembimbingIndustri->email) }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-6 rounded-lg inline-flex items-center transition-colors duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update Pembimbing
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 