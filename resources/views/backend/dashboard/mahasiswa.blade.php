<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Dashboard Mahasiswa</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('styles')
</head>

<body class="bg-gray-100 font-['Poppins']">
    <!-- Overlay for mobile -->
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden md:hidden"></div>

    <!-- Toggle Button -->
    <button id="menu-toggle" class="fixed top-4 left-4 z-50 p-2 rounded-lg bg-white shadow-lg md:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Sidebar -->
    <nav id="sidebar"
        class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-40">
        <!-- Logo -->
        <div class="flex items-center justify-center gap-x-3 py-8 border-b">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16a34a" class="w-8 h-8">
                <path
                    d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                <path
                    d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                <path
                    d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
            </svg>
            <span class="text-2xl font-bold">SIMAG</span>
        </div>

        <!-- Navigation Links -->
        <div class="flex flex-col justify-between h-[calc(100%-5rem)]">
            <ul class="px-4 py-6 space-y-2">
                <li>
                    <a href=""
                        class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.lowonganPKL.index') }}"
                        class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('mahasiswa/lowonganPKL') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                        </svg>
                        <span>Lowongan PKL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.pengajuanPKL.index') }}"
                        class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('mahasiswa/pengajuanPKL') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                        <span>Pengajuan PKL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.daftarPerusahaanPKL.index') }}"
                        class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('mahasiswa/daftarPerusahaanPKL') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span>Daftar Perusahaan PKL</span>
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('mahasiswa.suratPernyataan.index') }}" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('mahasiswa/suratPernyataan') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Surat Permohonan</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('mahasiswa.suratPKL.index') }}"
                        class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('mahasiswa/suratPKL') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Surat PKL</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.pembimbingIndustri.index') }}"
                        class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('mahasiswa/pembimbingIndustri') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Pembimbing Industri</span>
                    </a>
                </li>
                <li>
                    <a href=""
                        class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profil</span>
                    </a>
                </li>
            </ul>

            <!-- User Info & Logout -->
            <div class="px-4 py-6 border-t">
                <div class="px-4 py-3 rounded-lg bg-gray-100 mb-4">
                    <p class="text-sm font-medium text-gray-600">{{ Auth::user()->username }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                </div>
                <a href="{{ route('logout') }}"
                    class="flex items-center justify-between px-4 py-3 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                    <span class="font-medium">Logout</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="transition-all duration-300 md:ml-64">
        <div class="p-6">
            <div class="bg-white rounded-xl shadow-sm">
                @yield('content')
            </div>
        </div>
    </main>

    @stack('scripts')

    <script>
        // Toggle Sidebar
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('translate-x-0');
            overlay.classList.toggle('hidden');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.remove('translate-x-0');
            overlay.classList.add('hidden');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 768) {
                if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
                    sidebar.classList.remove('translate-x-0');
                    overlay.classList.add('hidden');
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                overlay.classList.add('hidden');
                sidebar.classList.remove('-translate-x-full');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>

</html>
