@extends('auth.entry')
@section('content')
<div class="flex min-h-screen relative items-center justify-center p-4">
    <div class="w-full max-w-md rounded-2xl border border-gray-100 login-card p-8 shadow-xl animate-fade-in">
        <div class="flex flex-col items-center text-2xl pb-7">
            <div class="bg-green-100 p-4 rounded-full mb-3 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16a34a"
                    class="size-12 flex-initial transform transition-transform hover:scale-110 duration-300">
                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    <path d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                </svg>
            </div>
            <h3 class="text-slate-950 font-bold text-3xl bg-gradient-to-r from-green-600 to-green-400 bg-clip-text text-transparent">
                SIMAG
            </h3>
        </div>
        <div class="space-y-2 text-center mb-8">
            <h2 class="text-2xl font-semibold text-gray-800">Registrasi Mahasiswa</h2>
            <p class="text-sm text-gray-500">Silakan isi data di bawah untuk membuat akun mahasiswa</p>
        </div>
        @if ($errors->any())
            <div class="mt-4 rounded-md bg-red-50 p-4 text-sm text-red-600 animate-fade-in">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('register.mahasiswa') }}" class="space-y-6 mt-6">
            @csrf
            <div class="space-y-2">
                <label for="username" class="text-sm font-medium text-gray-700 block">Username</label>
                <input id="username" name="username" type="text" required autofocus
                    class="input-transition flex h-11 w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-200 text-slate-900"
                    placeholder="Masukkan Username/NIM">
            </div>
            <div class="space-y-2">
                <label for="email" class="text-sm font-medium text-gray-700 block">Email</label>
                <input id="email" name="email" type="email" required
                    class="input-transition flex h-11 w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-200 text-slate-900"
                    placeholder="Masukkan Email">
            </div>
            <div class="space-y-2">
                <label for="password" class="text-sm font-medium text-gray-700 block">Password</label>
                <input id="password" name="password" type="password" required
                    class="input-transition flex h-11 w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-200 text-slate-900"
                    placeholder="••••••••">
            </div>
            <div class="space-y-2">
                <label for="password_confirmation" class="text-sm font-medium text-gray-700 block">Konfirmasi Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="input-transition flex h-11 w-full rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm placeholder:text-gray-400 focus:border-green-500 focus:ring-2 focus:ring-green-200 text-slate-900"
                    placeholder="••••••••">
            </div>
            <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-lg bg-green-500 px-4 py-3 text-sm font-medium text-white transition-all duration-300 hover:bg-green-600 hover:shadow-lg transform hover:-translate-y-0.5 focus:ring-2 focus:ring-green-200">
                Daftar
            </button>
        </form>
        <div class="mt-8 flex flex-col space-y-4">
            <a href="/entry"
                class="inline-flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-green-600 transition-all duration-300 hover:bg-green-50 hover:shadow-md transform hover:-translate-y-0.5">
                Kembali ke Login
            </a>
        </div>
    </div>
</div>
@endsection 