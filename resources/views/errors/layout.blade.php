<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('code', '500') - @yield('title', 'Server Error')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-danger-900 via-danger-800 to-danger-900">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <!-- Error Code -->
            <div class="mb-8">
                <h1 class="text-9xl font-bold text-white mb-4 animate-pulse">@yield('code', '500')</h1>
                <div class="w-32 h-1 bg-white/50 mx-auto rounded-full mb-6"></div>
            </div>

            <!-- Icon -->
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-white/20 rounded-full mb-4">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
            </div>

            <!-- Message -->
            <h2 class="text-3xl font-bold text-white mb-3">@yield('title', 'Server Error')</h2>
            <p class="text-white/80 mb-8 text-lg">
                @yield('message', 'Maaf, terjadi kesalahan pada server. Tim kami sudah diberitahu dan sedang memperbaikinya.')
            </p>

            <!-- Action -->
            <a href="{{ url('/') }}"
                class="inline-block px-8 py-3 bg-white text-danger-900 rounded-lg font-semibold hover:bg-white/90 transition-all duration-200 shadow-lg hover:shadow-xl">
                🏠 Kembali ke Beranda
            </a>

            <!-- Footer -->
            <p class="text-white/60 text-sm mt-8">
                Error Code: <span class="font-mono font-semibold">HTTP @yield('code', '500')</span>
            </p>
        </div>
    </div>
</body>

</html>