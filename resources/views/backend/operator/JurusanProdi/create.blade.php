@extends('backend.dashboard.operator')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Tambah Jurusan/Prodi</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <form action="{{ route('operator.jurusanProdi.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="nama_prodi" class="block text-sm font-medium text-gray-700">Nama Prodi</label>
                            <input type="text" name="nama_prodi" id="nama_prodi" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                            <input type="text" name="jurusan" id="jurusan" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label for="nama_kaprodi" class="block text-sm font-medium text-gray-700">Nama Kaprodi</label>
                            <input type="text" name="nama_kaprodi" id="nama_kaprodi" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('operator.jurusanProdi.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
