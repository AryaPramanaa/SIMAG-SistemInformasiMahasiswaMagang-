@extends('backend.dashboard.perusahaan')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Pembimbing Industri</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>
        <div class="mb-6">
            <a href="{{ route('perusahaan.pembimbingIndustri.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Informasi Pembimbing</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pembimbing</label>
                            <p class="text-gray-900">{{ $pembimbingIndustri->nama_pembimbing }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                            <p class="text-gray-900">{{ $pembimbingIndustri->jabatan }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kontak</label>
                            <p class="text-gray-900">{{ $pembimbingIndustri->kontak }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900">{{ $pembimbingIndustri->email }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Perusahaan</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                            <p class="text-gray-900">{{ $pembimbingIndustri->perusahaan->nama_perusahaan ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Kelola Mahasiswa Bimbingan</h3>
            
            <!-- Search Box -->
            <div class="mb-6">
                <div class="relative">
                    <input type="text" id="searchMahasiswa" placeholder="Cari mahasiswa berdasarkan nama, NIM, atau email..." 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <form action="{{ route('perusahaan.pembimbingIndustri.assignMahasiswa', $pembimbingIndustri->id) }}" method="POST">
                @csrf
                <div id="mahasiswaList" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 max-h-96 overflow-y-auto">
                    @foreach($allMahasiswa as $mahasiswa)
                        <div class="mahasiswa-item flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                            <input type="checkbox" name="mahasiswa_ids[]" value="{{ $mahasiswa->id }}" id="mahasiswa_{{ $mahasiswa->id }}"
                                {{ $pembimbingIndustri->mahasiswas->contains($mahasiswa->id) ? 'checked' : '' }}
                                class="mr-3">
                            <label for="mahasiswa_{{ $mahasiswa->id }}" class="text-gray-700 cursor-pointer flex-1">
                                <div class="font-medium">{{ $mahasiswa->nama }}</div>
                                <div class="text-sm text-gray-500">NIM: {{ $mahasiswa->nomor_unik }}</div>
                                <div class="text-sm text-gray-500">{{ $mahasiswa->email }}</div>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        <span id="selectedCount">0</span> mahasiswa dipilih
                    </div>
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Simpan Mahasiswa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchMahasiswa').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const mahasiswaItems = document.querySelectorAll('.mahasiswa-item');
            let visibleCount = 0;

            mahasiswaItems.forEach(item => {
                const nama = item.querySelector('label').textContent.toLowerCase();
                const nim = item.querySelector('.text-sm').textContent.toLowerCase();
                const email = item.querySelectorAll('.text-sm')[1].textContent.toLowerCase();
                
                if (nama.includes(searchTerm) || nim.includes(searchTerm) || email.includes(searchTerm)) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Update selected count
            updateSelectedCount();
        });

        // Update selected count
        function updateSelectedCount() {
            const checkedBoxes = document.querySelectorAll('input[name="mahasiswa_ids[]"]:checked');
            document.getElementById('selectedCount').textContent = checkedBoxes.length;
        }

        // Listen for checkbox changes
        document.querySelectorAll('input[name="mahasiswa_ids[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // Initialize count
        updateSelectedCount();
    </script>
@endsection
