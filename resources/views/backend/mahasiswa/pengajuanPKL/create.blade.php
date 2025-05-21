@extends('backend.dashboard.admin')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('pengajuanPKL.index') }}" class="inline-flex items-center text-gray-700 hover:text-green-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span class="text-lg font-medium">Kembali</span>
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
            <p class="text-gray-600 mt-4">Silakan lengkapi formulir di bawah ini untuk mengajukan PKL</p>
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

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <form action="{{ route('pengajuanPKL.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                <!-- Mahasiswa & Perusahaan Selection -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="mahasiswa_id" class="text-base font-semibold text-gray-700">Nama Mahasiswa</label>
                        <select id="mahasiswa_id" name="mahasiswa_id" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm select2">
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}" data-nim="{{ $mahasiswa->nim }}">{{ $mahasiswa->nama }} - {{ $mahasiswa->nim }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label for="perusahaan_id" class="text-base font-semibold text-gray-700">Perusahaan PKL</label>
                        <select id="perusahaan_id" name="perusahaan_id" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm select2">
                            <option value="">Pilih Perusahaan</option>
                            @foreach($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id }}">{{ $perusahaan->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tanggal dan Durasi -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="tanggal_pengajuan" class="text-base font-semibold text-gray-700">Tanggal Pengajuan</label>
                        <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan" required
                            value="{{ date('Y-m-d') }}" readonly
                            class="w-full h-[42px] rounded-lg border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500 shadow-sm">
                        <p class="text-sm text-gray-500">Tanggal pengajuan otomatis hari ini</p>
                    </div>
                    <div class="space-y-2">
                        <label for="divisi_pilihan" class="text-base font-semibold text-gray-700">Divisi Pilihan</label>
                        <input type="text" id="divisi_pilihan" name="divisi_pilihan" required
                            class="w-full h-[42px] rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm"
                            placeholder="Masukkan divisi yang diinginkan">
                        <p class="text-sm text-gray-500">Masukkan divisi yang diinginkan untuk PKL</p>
                    </div>
                </div>

                <!-- Surat Pengantar -->
                <div class="space-y-2">
                    <label for="surat_pengantar_path" class="text-base font-semibold text-gray-700">
                        Surat Pengantar Kampus
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-500 transition-colors">
                        <div class="space-y-2 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <label for="surat_pengantar_path" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                    <span>Upload file</span>
                                    <input id="surat_pengantar_path" name="surat_pengantar_path" type="file" class="sr-only" required accept=".pdf,.doc,.docx">
                                </label>
                                <p class="pl-1">atau drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF atau DOC hingga 10MB</p>
                            @error('surat_pengantar_path')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 pt-6">
                    <a href="{{ route('pengajuanPKL.index') }}" 
                        class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 font-medium">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-medium">
                        Ajukan PKL
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .select2-container--default .select2-selection--single {
        height: 42px;
        border-color: #D1D5DB;
        border-radius: 0.5rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 42px;
        padding-left: 1rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }
    .select2-container--default .select2-search--dropdown .select2-search__field {
        border-color: #D1D5DB;
        border-radius: 0.375rem;
    }
    .select2-dropdown {
        border-color: #D1D5DB;
        border-radius: 0.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Cari nama atau NIM mahasiswa",
            allowClear: true,
            matcher: function(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Do not display the item if there is no 'text' property
                if (typeof data.text === 'undefined') {
                    return null;
                }

                // Search in both name and NIM
                var searchStr = data.text.toLowerCase();
                if (searchStr.indexOf(params.term.toLowerCase()) > -1) {
                    return data;
                }

                // Return `null` if the term should not be displayed
                return null;
            }
        });

        // Initialize Select2 for perusahaan dropdown
        $('#perusahaan_id').select2({
            placeholder: "Pilih Perusahaan",
            allowClear: true
        });
    });
</script>
@endpush