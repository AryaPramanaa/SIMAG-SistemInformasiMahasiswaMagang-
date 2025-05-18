@extends('backend.dashboard.admin')
@section('content')
    <h1 class="text-center font-semibold text-2xl py-10">PENGAJUAN PKL</h1>
    <a href="pengajuanPKL/create"
        class="border-2 hover:border-green-200 py-2 px-4 rounded-lg bg-green-700 text-slate-50 hover:bg-green-600 ">Daftar</a>
    <div class="overflow-auto rounded-xl shadow-lg mt-5">
        <table class="w-full ">
            <!-- head -->
            <thead class="bg-gray-200 border-b-2 border-gray-200">
                <tr>
                    <th
                        class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap ">
                        NO</th>
                    <th
                        class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                        NAMA</th>
                    <th
                        class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                        PERUSAHAAN PKL</th>
                    <th
                        class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                        STATUS</th>
                    <th
                        class="px-6 py-4 text-center text-xs font-bold text-gray-900 uppercase tracking-wider whitespace-nowrap">
                        AKSI</th>
                </tr>
            </thead>
            <tbody class=" divide-y divide-gray-200">
                @foreach ($mahasiswas as $student)
                    <tr>
                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                            {{ $loop->index + 1 }}</td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                            {{ $student->nama }}</td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                            {{ $student->perusahaan }}</td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center">
                            <span
                                @if ($student->status == 'pending') class="p-2 text-xs font-medium uppercase tracking-wider text-gray-800 bg-gray-200 rounded-lg bg-opacity-50"
                            @else
                            class="p-2 text-xs font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50" @endif>
                                {{ $student->status }}
                            </span>
                        </td>
                        <td
                            class="px-6 py-5 whitespace-nowrap text-sm font-semibold text-gray-500 text-center flex justify-center items-center">
                            <a
                                href="pengajuanPKL/{{ $student->id }}/edit"class="border-2 border-yellow-300 py-2 px-4 rounded-lg bg-yellow-300 text-slate-950 hover:bg-yellow-400 hover:border-yellow-400">Update</a>
                            <form action="/pengajuanPKL/{{ $student->id }}" method="post">
                                @method('delete')
                                @csrf
                                <a class="border-2 border-red-600 py-2 px-4 ml-1 rounded-lg bg-red-600 text-slate-950 hover:bg-red-700 hover:border-red-700"
                                    onclick="return confirm('yakin akan menghapus data ?')">Delete</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
