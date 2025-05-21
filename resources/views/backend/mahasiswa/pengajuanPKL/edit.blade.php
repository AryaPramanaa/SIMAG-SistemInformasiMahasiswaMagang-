@extends('backend.dashboard.admin')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('pengajuanPKL.show', $pengajuan->id) }}" class="inline-flex items-center text-gray-700 hover:text-green-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span class="text-lg font-medium">Kembali</span>
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('pengajuanPKL.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Mahasiswa & Perusahaan Selection -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="mahasiswa_id" class="text-base font-semibold text-gray-700">Nama Mahasiswa</label>
                        <select id="mahasiswa_id" name="mahasiswa_id" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}" {{ $pengajuan->mahasiswa_id == $mahasiswa->id ? 'selected' : '' }}>
                                    {{ $mahasiswa->nama }} - {{ $mahasiswa->nim }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="perusahaan_id" class="text-base font-semibold text-gray-700">Perusahaan PKL</label>
                        <select id="perusahaan_id" name="perusahaan_id" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">
                            <option value="">Pilih Perusahaan</option>
                            @foreach($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id }}" {{ $pengajuan->perusahaan_id == $perusahaan->id ? 'selected' : '' }}>
                                    {{ $perusahaan->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tanggal dan Status -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="tanggal_pengajuan" class="text-base font-semibold text-gray-700">Tanggal Pengajuan</label>
                        <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan" required
                            value="{{ $pengajuan->tanggal_pengajuan }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">
                    </div>
                    <div class="space-y-2">
                        <label for="status" class="text-base font-semibold text-gray-700">Status</label>
                        <select id="status" name="status" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">
                            <option value="Pending" {{ $pengajuan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diterima" {{ $pengajuan->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak" {{ $pengajuan->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                </div>

                <!-- Divisi PKL -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="divisi_pilihan" class="text-base font-semibold text-gray-700">Divisi Pilihan</label>
                        <input type="text" id="divisi_pilihan" name="divisi_pilihan" required
                            value="{{ $pengajuan->divisi_pilihan }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm"
                            placeholder="Masukkan divisi yang diinginkan">
                        <p class="text-sm text-gray-500">Masukkan divisi yang diinginkan untuk PKL</p>
                    </div>

                    <!-- Current File Info -->
                    <div class="space-y-2">
                        <label class="text-base font-semibold text-gray-700">Surat Pengantar</label>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-600 mb-2">File saat ini:</p>
                            <a href="{{ Storage::url($pengajuan->surat_pengantar_path) }}" 
                               class="inline-flex items-center text-green-600 hover:text-green-700 mb-4">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Lihat File
                            </a>
                            <div class="mt-2">
                                <label for="surat_pengantar_path" class="block text-sm text-gray-600">Upload file baru (opsional):</label>
                                <input type="file" id="surat_pengantar_path" name="surat_pengantar_path" accept=".pdf,.doc,.docx"
                                    class="mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                                <p class="text-xs text-gray-500 mt-1">PDF atau DOC hingga 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('pengajuanPKL.show', $pengajuan->id) }}" 
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 font-medium">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-medium">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const durasiMulai = document.getElementById('durasi_mulai');
            const durasiSelesai = document.getElementById('durasi_selesai');

            durasiMulai.addEventListener('change', function() {
                // Set minimum end date to 1 month after start date
                const startDate = new Date(this.value);
                const minEndDate = new Date(startDate);
                minEndDate.setMonth(startDate.getMonth() + 1);
                durasiSelesai.min = minEndDate.toISOString().split('T')[0];
                
                // If current end date is before new minimum, update it
                if (new Date(durasiSelesai.value) < minEndDate) {
                    durasiSelesai.value = minEndDate.toISOString().split('T')[0];
                }
            });
        });
    </script>
@endsection 