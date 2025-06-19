@extends('backend.dashboard.mahasiswa')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Edit Pengajuan PKL</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="mb-6">
            <a href="{{ route('mahasiswa.pengajuanPKL.show', $pengajuan->id) }}"
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
            <form action="{{ route('mahasiswa.pengajuanPKL.update', $pengajuan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="mahasiswa_id" class="block text-sm font-medium text-gray-700 mb-2">Nama Mahasiswa</label>
                        <select name="mahasiswa_id" id="mahasiswa_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Pilih Mahasiswa</option>
                            @foreach($mahasiswas as $mahasiswa)
                                <option value="{{ $mahasiswa->id }}" {{ $pengajuan->mahasiswa_id == $mahasiswa->id ? 'selected' : '' }}>
                                    {{ $mahasiswa->nama }} - {{ $mahasiswa->nim }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="perusahaan_id" class="block text-sm font-medium text-gray-700 mb-2">Perusahaan PKL</label>
                        <select name="perusahaan_id" id="perusahaan_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">Pilih Perusahaan</option>
                            @foreach($perusahaans as $perusahaan)
                                <option value="{{ $perusahaan->id }}" {{ $pengajuan->perusahaan_id == $perusahaan->id ? 'selected' : '' }}>
                                    {{ $perusahaan->nama_perusahaan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanggal_pengajuan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" value="{{ date('Y-m-d') }}" readonly
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <p class="mt-1 text-sm text-gray-500">Tanggal pengajuan otomatis hari ini</p>
                    </div>

                    <div>
                        <label for="divisi_pilihan" class="block text-sm font-medium text-gray-700 mb-2">Divisi Pilihan</label>
                        <input type="text" name="divisi_pilihan" id="divisi_pilihan" value="{{ old('divisi_pilihan', $pengajuan->divisi_pilihan) }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                            placeholder="Masukkan divisi yang diinginkan">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
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