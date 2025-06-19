@extends('backend.dashboard.operator')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Akun</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="mb-6">
            <a href="{{ route('operator.akun.index') }}"
                class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <p class="text-sm text-gray-900">{{ $akun->username }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <p class="text-sm text-gray-900">{{ $akun->email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <p class="text-sm text-gray-900">{{ ucfirst($akun->role) }}</p>
                </div>

                @if($akun->role === 'kaprodi' && $akun->prodi)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                    <p class="text-sm text-gray-900">{{ $akun->prodi->nama_prodi }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                    <p class="text-sm text-gray-900">{{ $akun->prodi->jurusan }}</p>
                </div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <p class="mt-1">
                        <span class="px-3 py-1 rounded-full text-xs
                            @if($akun->status == 'Aktif') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $akun->status }}
                        </span>
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('operator.akun.edit', $akun->id) }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection 