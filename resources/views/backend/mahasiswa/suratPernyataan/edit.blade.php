@extends('backend.dashboard.mahasiswa')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Surat Pernyataan</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="mb-6">
            <a href="{{ route('mahasiswa.suratPernyataan.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('mahasiswa.suratPernyataan.update', $suratPernyataan) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="perusahaan_id" class="block text-sm font-medium text-gray-700 mb-2">Perusahaan</label>
                        <select name="perusahaan_id" id="perusahaan_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Pilih Perusahaan</option>
                            @foreach($perusahaan as $p)
                                <option value="{{ $p->id }}" {{ (old('perusahaan_id', $suratPernyataan->perusahaan_id) == $p->id) ? 'selected' : '' }}>
                                    {{ $p->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_upload" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Upload</label>
                        <input type="date" name="tanggal_upload" id="tanggal_upload" value="{{ old('tanggal_upload', $suratPernyataan->tanggal_upload) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" readonly>
                    </div>

                    <div class="md:col-span-2">
                        <label for="surat_pernyataan" class="block text-sm font-medium text-gray-700 mb-2">File Surat Pernyataan (PDF)</label>
                        @if($suratPernyataan->surat_pernyataan)
                            <div class="mb-4">
                                <a href="{{ Storage::url('surat_pernyataan/' . $suratPernyataan->surat_pernyataan) }}" target="_blank" class="text-green-600 hover:text-green-700">
                                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Lihat file saat ini
                                </a>
                            </div>
                        @endif
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="surat_pernyataan" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                        <span>Upload file baru</span>
                                        <input id="surat_pernyataan" name="surat_pernyataan" type="file" class="sr-only" accept=".pdf" max="10485760">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PDF sampai 10MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('deskripsi', $suratPernyataan->deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        // Validasi file sebelum upload
        document.getElementById('surat_pernyataan').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi ukuran file (10MB)
                if (file.size > 10 * 1024 * 1024) {
                    alert('Ukuran file maksimal 10MB');
                    this.value = '';
                    return;
                }
                
                // Validasi tipe file
                if (file.type !== 'application/pdf') {
                    alert('File harus berformat PDF');
                    this.value = '';
                    return;
                }
            }
        });
    </script>
    @endpush
@endsection 