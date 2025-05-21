<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Dashboard Admin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Sidebar -->
    <nav id="sidebar" class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-40">
        <!-- Logo -->
        <div class="flex items-center justify-center gap-x-3 py-8 border-b">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16a34a" class="w-8 h-8">
                <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                <path d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                <path d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
            </svg>
            <span class="text-2xl font-bold">SIMAG</span>
        </div>

        <!-- Navigation Links -->
        <div class="flex flex-col justify-between h-[calc(100%-5rem)]">
            <ul class="px-4 py-6 space-y-2">
                <li>
                    <a href="/dashboard" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('dashboard') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/pengajuanPKL" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('pengajuanPKL*') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                        </svg>
                        <span>Pengajuan PKL</span>
                    </a>
                </li>
                <li>
                    <a href="/daftarPerusahaan" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('daftarPerusahaan*') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                        <span>Daftar Perusahaan PKL</span>
                    </a>
                </li>
                <li>
                    <a href="/surat-pengantar" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('surat-pengantar*') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                        <span>Surat Pengantar</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('mahasiswa.pembimbingIndustri.index') }}" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('mahasiswa/pembimbingIndustri*') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        <span>Pembimbing Industri</span>
                    </a>
                </li>
                <li>
                    <a href="/profile" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('profile*') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
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
                <a href="{{ route('logout') }}" class="flex items-center justify-between px-4 py-3 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                    <span class="font-medium">Logout</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
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
