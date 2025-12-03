<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Login - Sistem Absensi Modern</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />

    <!-- CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-md w-full">
            <!-- Logo & Title -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Sistem Absensi</h1>
                <p class="text-primary-100 text-lg">Modern Attendance System</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-secondary-900 mb-2">Selamat Datang</h2>
                    <p class="text-secondary-600">Silakan login menggunakan akun Google Anda</p>
                </div>

                <!-- Flash Messages -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
                    <div class="mb-4 p-4 bg-success-50 border border-success-200 rounded-lg">
                        <p class="text-success-600 font-medium text-sm"><?php echo e(session('success')); ?></p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(session()->has('error')): ?>
                    <div class="mb-4 p-4 bg-danger-50 border border-danger-200 rounded-lg">
                        <p class="text-danger-600 font-medium text-sm"><?php echo e(session('error')); ?></p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Google Login Button -->
                <a href="<?php echo e(route('auth.google')); ?>"
                    class="flex items-center justify-center w-full px-6 py-4 bg-white border-2 border-secondary-300 rounded-lg hover:bg-secondary-50 hover:border-secondary-400 transition-all duration-200 shadow-sm hover:shadow-md">
                    <svg class="w-6 h-6 mr-3" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    <span class="text-secondary-700 font-semibold text-lg">Login dengan Google</span>
                </a>

                <!-- Info Text -->
                <div class="mt-6 pt-6 border-t border-secondary-200">
                    <p class="text-xs text-secondary-500 text-center">
                        Dengan login, Anda menyetujui penggunaan sistem absensi ini.
                        <br>Pastikan Anda menggunakan akun Google yang terdaftar.
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-primary-100 text-sm">
                    © <?php echo e(date('Y')); ?> Wengset Technology. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html><?php /**PATH C:\Users\putri\Documents\Project\Bored\wengset-absensi\resources\views/login.blade.php ENDPATH**/ ?>