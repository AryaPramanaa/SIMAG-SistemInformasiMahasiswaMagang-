<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Dashboard Pimpinan</title>

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
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar w-[17%] md:w-[17%] top-0 left-0 min-h-screen bg-white shadow-lg transform transition-all duration-300 ease-in-out z-40 flex flex-col relative">
            <!-- Collapse/Expand Button -->
            <button id="sidebar-toggle" class="absolute top-4 right-[-16px] z-50 p-1 rounded-full bg-white shadow-lg border border-gray-200">
                <svg id="sidebar-toggle-icon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path id="sidebar-toggle-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <!-- Logo -->
            <div class="flex items-center justify-center gap-x-3 py-8 border-b">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16a34a" class="w-8 h-8">
                    <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    <path d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                    <path d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                </svg>
                <span class="text-2xl font-bold sidebar-label transition-all duration-200 origin-left">SIMAG</span>
            </div>
            <!-- Navigation Links -->
            <div class="flex-1 flex flex-col justify-between overflow-y-auto">
                <ul class="px-4 py-6 space-y-2">
                    <li>
                        <a href="" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span class="sidebar-label transition-all duration-200 origin-left">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pimpinan.laporanMahasiswa.index') }}" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('pimpinan/laporanMahasiswa*') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m-6 4h6a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2zm3-10h.01" />
                            </svg>
                            <span class="sidebar-label transition-all duration-200 origin-left">Laporan Mahasiswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pimpinan.rekapMahasiswaPKL.index') }}" class="flex items-center gap-x-3 px-4 py-3 rounded-lg {{ request()->is('pimpinan/rekapMahasiswaPKL*') ? 'bg-green-100 text-green-600' : 'hover:bg-gray-100' }} transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                            </svg>
                            <span class="sidebar-label transition-all duration-200 origin-left">Rekap Mahasiswa PKL</span>
                        </a>
                    </li>
                </ul>
                <!-- User Info & Logout -->
                <div class="px-4 py-6 border-t">
                    <div class="px-4 py-3 rounded-lg bg-gray-100 mb-4 flex items-center gap-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-600 sidebar-label transition-all duration-200 origin-left">{{ Auth::user()->username }}</p>
                            <p class="text-xs text-gray-500 sidebar-label transition-all duration-200 origin-left">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="GET">
                        <button type="submit" class="flex items-center justify-between w-full px-4 py-3 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors">
                            <span class="font-medium sidebar-label transition-all duration-200 origin-left">Logout</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <!-- Main Content -->
        <main id="main-content" class="transition-all duration-300 flex-1 min-h-screen">
            <div class="p-6">
                <div class="bg-white rounded-xl shadow-sm">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @stack('scripts')
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebarLabels = document.querySelectorAll('.sidebar-label');
        const sidebarTogglePath = document.getElementById('sidebar-toggle-path');
        let isCollapsed = false;
        // Collapse/Expand Sidebar
        sidebarToggle?.addEventListener('click', () => {
            isCollapsed = !isCollapsed;
            sidebar.classList.toggle('collapsed', isCollapsed);
            sidebarLabels.forEach(label => label.classList.toggle('hidden', isCollapsed));
            // Ganti arah panah
            sidebarTogglePath.setAttribute('d', isCollapsed
                ? 'M9 5l7 7-7 7' // panah kanan
                : 'M15 19l-7-7 7-7' // panah kiri
            );
            // Simpan state ke localStorage
            localStorage.setItem('sidebarCollapsedPimpinan', isCollapsed ? '1' : '0');
        });
        // Saat halaman dimuat, cek localStorage
        document.addEventListener('DOMContentLoaded', () => {
            const collapsed = localStorage.getItem('sidebarCollapsedPimpinan') === '1';
            if (collapsed) {
                isCollapsed = true;
                sidebar.classList.add('collapsed');
                sidebarLabels.forEach(label => label.classList.add('hidden'));
                sidebarTogglePath.setAttribute('d', 'M9 5l7 7-7 7');
            }
        });
    </script>
    <style>
        .sidebar.collapsed {
            width: 5rem !important;
        }
        .sidebar.collapsed .sidebar-label {
            display: none !important;
        }
        .sidebar a {
            width: 100%;
            min-height: 48px;
        }
        .sidebar .bg-green-100,
        .sidebar .bg-gray-100 {
            width: 100%;
        }
    </style>
</body>

</html>
