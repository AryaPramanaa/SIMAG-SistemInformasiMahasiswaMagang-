@extends('backend.dashboard.mahasiswa')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('mahasiswa.pengajuanPKL.show', $pengajuan->id) }}" class="inline-flex items-center text-gray-700 hover:text-green-600 transition-colors">
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
            <form action="{{ route('mahasiswa.pengajuanPKL.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                <!-- Mahasiswa & Perusahaan Selection -->
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="mahasiswa_id" class="text-base font-semibold text-gray-700">Nama Mahasiswa</label>
                        <select id="mahasiswa_id" name="mahasiswa_id" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm select2">
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
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm select2">
                            <option value="">Pilih Perusahaan</option>
                            @foreach($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id }}" {{ $pengajuan->perusahaan_id == $perusahaan->id ? 'selected' : '' }}>
                                    {{ $perusahaan->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tanggal Pengajuan -->
                <div class="space-y-2">
                    <label for="tanggal_pengajuan" class="text-base font-semibold text-gray-700">Tanggal Pengajuan</label>
                    <input type="date" id="tanggal_pengajuan" name="tanggal_pengajuan" required
                        value="{{ date('Y-m-d') }}" readonly
                        class="w-full h-[42px] rounded-lg border-gray-300 bg-gray-50 focus:border-green-500 focus:ring-green-500 shadow-sm">
                    <p class="text-sm text-gray-500">Tanggal pengajuan otomatis hari ini</p>
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
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <a href="{{ route('mahasiswa.pengajuanPKL.show', $pengajuan->id) }}" 
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
        // Initialize Select2 for mahasiswa dropdown
        $('#mahasiswa_id').select2({
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
            placeholder: "Cari Perusahaan",
            allowClear: true
        });
    });
</script>
@endpush 