<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Sistem Manajemen Magang</title>



    <!-- Tailwind CSS via CDN -->
    @vite('resources/css/app.css')


    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Titillium+Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700&display=swap"
        rel="stylesheet">


    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="{{ asset('js/lucide.js') }}"></script>
    <script>
        lucide.createIcons();
    </script>


    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: "#4f46e5",
                            foreground: "#ffffff",
                        },
                        muted: {
                            DEFAULT: "#f3f4f6",
                            foreground: "#6b7280",
                        },
                        accent: {
                            DEFAULT: "#eff6ff",
                            foreground: "#1e40af",
                        },
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-[#f1f4f5] font-['Poppins']">
    <div class="flex min-h-screen relative items-center justify-center p-4">
        @if(session('error'))
            <div class="px-5 py-3 rounded-lg absolute top-5 right-5 bg-red-500 font-semibold text-xl">
                <p class="">{{ session('error') }}</p>
            </div>
        @endif
        <div class="w-full max-w-md rounded-lg border border-gray-200 bg-white p-6 shadow-md ">
            <div class="flex flex-col items-center text-2xl pb-5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#16a34a"
                    class="size-10 flex-initial ">
                    <path
                        d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    <path
                        d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                    <path
                        d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                </svg>
                <h3 class="text-slate-950 font-['Manrope] font-bold">
                    SIMAG
                </h3>
            </div>


            <div class="space-y-1 text-center">
                <h2 class="text-xl font-normal text-gray-900 ">Login</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Masukkan kredensial untuk mengakses akun Anda</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div
                    class="mt-4 rounded-md bg-blue-50 p-4 text-sm text-blue-600 dark:bg-blue-900/50 dark:text-blue-200">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mt-4 rounded-md bg-red-50 p-4 text-sm text-red-600 dark:bg-red-900/50 dark:text-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-6">
                <div class="mt-6">
                    <!-- Unified Login Form (works for all roles) -->
                    <form id="form-student" method="post" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div class="space-y-2">
                            <label for="input_type" id="label_input"
                                class="text-sm font-medium text-gray-700">Username</label>
                            <input id="input_type" name="username" type="text"
                                placeholder="Masukkan Username atau NIM Anda" required
                                class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder:text-gray-400 hover:shadow-lg text-slate-900  "
                                value="" autofocus>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label for="password"
                                    class="text-sm font-medium text-gray-700">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="" class="text-xs text-black hover:underline">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>
                            <input id="password" name="password" type="password" placeholder="••••••••" required
                                class="flex h-10 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder:text-gray-400 text-slate-900  hover:shadow-lg  active:bg-white active:text-slate-900">
                        </div>

                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="remember" name="remember"
                                class="h-4 w-4 rounded border-gray-300 bg-white">
                            <label for="remember" class="text-sm text-gray-600 ">Ingat saya</label>
                        </div>

                        <button type="submit" id="login-button"
                            class="inline-flex w-full items-center justify-center rounded-md bg-green-500 hover:bg-green-600  px-4 py-2 text-sm font-medium hover:shadow-xl text-white">
                            Login
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-6 flex flex-col space-y-4">
                <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                    Tidak memiliki akun? Hubungi administrator Anda
                </div>
                <a href="/"
                    class="inline-flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-green-600 hover:bg-green-100">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    
</body>

</html>
