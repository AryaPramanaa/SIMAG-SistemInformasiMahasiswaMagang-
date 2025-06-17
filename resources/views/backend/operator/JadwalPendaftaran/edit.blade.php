@extends('backend.dashboard.operator')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Jadwal Pendaftaran</h1>
                <div class="w-40 h-1 bg-green-500 mx-auto"></div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('operator.jadwalPendaftaran.update', $jadwalPendaftaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                        <select name="prodi_id" id="prodi_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($prodis as $prodi)
                                <option value="{{ $prodi->id }}" {{ $jadwalPendaftaran->prodi_id == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="tanggal_buka" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Buka</label>
                        <input type="date" name="tanggal_buka" id="tanggal_buka" required
                            value="{{ $jadwalPendaftaran->tanggal_buka }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('tanggal_buka')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="tanggal_tutup" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Tutup</label>
                        <input type="date" name="tanggal_tutup" id="tanggal_tutup" required
                            value="{{ $jadwalPendaftaran->tanggal_tutup }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('tanggal_tutup')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="tahun_akademik" class="block text-sm font-medium text-gray-700 mb-2">Tahun Akademik</label>
                        <input type="text" name="tahun_akademik" id="tahun_akademik" required
                            value="{{ $jadwalPendaftaran->tahun_akademik }}"
                            placeholder="Contoh: 2023/2024"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('tahun_akademik')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                            placeholder="Masukkan deskripsi jadwal pendaftaran">{{ $jadwalPendaftaran->deskripsi }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('operator.jadwalPendaftaran.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
