@extends('backend.dashboard.operator')

@section('content')
    <div class="min-h-screen py-8 px-4 md:px-8">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">Detail Akun</h1>
            <div class="w-40 h-1 bg-green-500 mx-auto"></div>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $akun->username }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nomor Unik (NIM/NIP/NPP)</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $akun->nomor_unik }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $akun->email }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <p class="mt-1 text-sm text-gray-900">{{ ucfirst($akun->role) }}</p>
                    </div>

                    @if($akun->role === 'kaprodi' && $akun->prodi)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $akun->prodi->nama_prodi }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jurusan</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $akun->prodi->jurusan }}</p>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <p class="mt-1">
                            <span class="px-3 py-1 rounded-full text-xs
                                @if($akun->status == 'Aktif') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ $akun->status }}
                            </span>
                        </p>
                    </div>

                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Dibuat</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $akun->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Terakhir Diperbarui</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $akun->updated_at->format('d/m/Y H:i') }}</p>
                    </div> --}}

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('operator.akun.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Kembali
                        </a>
                        <a href="{{ route('operator.akun.edit', $akun->id) }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 