@extends('backend.dashboard.kaprodi')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Status Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('kaprodi.pengajuanPKL.update', $pengajuan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Student Information -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Mahasiswa</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nama</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->mahasiswa->nama }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nomor Unik</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->mahasiswa->nomor_unik }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Program Studi</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->mahasiswa->prodi->nama_prodi }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Company Information -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Perusahaan</h2>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Nama Perusahaan</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->perusahaan->nama_perusahaan }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-600">Divisi</label>
                                <p class="mt-1 text-gray-900">{{ $pengajuan->divisi_pilihan }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Update -->
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Update Status</h2>
                        <div class="space-y-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                    <option value="Pending" {{ $pengajuan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Diterima" {{ $pengajuan->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="Ditolak" {{ $pengajuan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="alasanPenolakan" class="{{ $pengajuan->status == 'Ditolak' ? '' : 'hidden' }}">
                                <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700">Alasan Penolakan</label>
                                <textarea name="alasan_penolakan" id="alasan_penolakan" rows="3"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">{{ old('alasan_penolakan', $pengajuan->alasan_penolakan) }}</textarea>
                                @error('alasan_penolakan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('kaprodi.pengajuanPKL.show', $pengajuan->id) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('status').addEventListener('change', function() {
            const alasanPenolakan = document.getElementById('alasanPenolakan');
            if (this.value === 'Ditolak') {
                alasanPenolakan.classList.remove('hidden');
            } else {
                alasanPenolakan.classList.add('hidden');
            }
        });
    </script>
    @endpush
@endsection
