@extends('backend.dashboard.kaprodi')
@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Pembimbing Akademik</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Informasi Dasar -->
                <div class="p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Dasar</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Nama</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $pembimbingAkademik->nama }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">NIP</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $pembimbingAkademik->nip }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jurusan</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $pembimbingAkademik->prodi->jurusan }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Program Studi</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $pembimbingAkademik->prodi->nama_prodi }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Kapasitas Bimbingan</p>
                            <p class="mt-1 text-sm text-gray-900">{{ $pembimbingAkademik->kapasitas_bimbingan }}</p>
                        </div>
                    </div>
                </div>

                <!-- Daftar Mahasiswa Bimbingan -->
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Mahasiswa Bimbingan</h2>
                        <span class="px-3 py-1 text-sm font-medium rounded-full {{ $pembimbingAkademik->mahasiswas->count() >= $pembimbingAkademik->kapasitas_bimbingan ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                            {{ $pembimbingAkademik->mahasiswas->count() }}/{{ $pembimbingAkademik->kapasitas_bimbingan }}
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">NO</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">NIM</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">NAMA</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">AKSI</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($pembimbingAkademik->mahasiswas as $index => $mahasiswa)
                                    <tr class="bg-white hover:bg-gray-50">
                                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $index + 1 }}</td>
                                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $mahasiswa->nim }}</td>
                                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">{{ $mahasiswa->nama }}</td>
                                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-center">
                                            <form action="{{ route('pembimbing-akademik.remove-mahasiswa', [$pembimbingAkademik, $mahasiswa]) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini dari bimbingan?')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-5 text-center text-sm text-gray-500">Belum ada mahasiswa yang dibimbing</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Form Tambah Mahasiswa -->
                @if($pembimbingAkademik->mahasiswas->count() < $pembimbingAkademik->kapasitas_bimbingan)
                    <div class="p-6 border-t">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Tambah Mahasiswa Bimbingan</h2>
                        <form action="{{ route('pembimbing-akademik.assign-mahasiswa', $pembimbingAkademik) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="mahasiswa_ids" class="block text-sm font-medium text-gray-700">Pilih Mahasiswa</label>
                                    <select name="mahasiswa_ids[]" id="mahasiswa_ids" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500" multiple required>
                                        @foreach($availableStudents as $mahasiswa)
                                            <option value="{{ $mahasiswa->id }}">{{ $mahasiswa->nim }} - {{ $mahasiswa->nama }}</option>
                                        @endforeach
                                    </select>
                                    @if($availableStudents->isEmpty())
                                        <p class="mt-2 text-sm text-gray-500">Tidak ada mahasiswa yang tersedia untuk dipasangkan</p>
                                    @endif
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                        Tambah Mahasiswa
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="p-6 border-t bg-gray-50">
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('pembimbing-akademik.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Kembali
                        </a>
                        <a href="{{ route('pembimbing-akademik.edit', $pembimbingAkademik) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#mahasiswa_ids').select2({
            placeholder: 'Pilih mahasiswa',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush 