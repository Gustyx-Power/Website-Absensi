<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? 'Admin Dashboard'); ?> - Sistem Absensi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />

    <!-- CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-secondary-50">
        <!-- Sidebar Navigation -->
        <aside class="fixed inset-y-0 left-0 w-64 bg-white border-r border-secondary-200 hidden lg:block">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 border-b border-secondary-200">
                    <h1 class="text-xl font-bold text-primary-600">Sistem Absensi</h1>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 px-4 py-6 space-y-2">
                    <a href="<?php echo e(route('admin.dashboard')); ?>"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-secondary-100 <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600' : 'text-secondary-700'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="<?php echo e(route('admin.employees')); ?>"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-secondary-100 <?php echo e(request()->routeIs('admin.employees') ? 'bg-primary-50 text-primary-600' : 'text-secondary-700'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Data Karyawan
                    </a>

                    <a href="<?php echo e(route('admin.reports')); ?>"
                        class="flex items-center px-4 py-3 rounded-lg hover:bg-secondary-100 <?php echo e(request()->routeIs('admin.reports') ? 'bg-primary-50 text-primary-600' : 'text-secondary-700'); ?>">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Laporan Absensi
                    </a>
                </nav>

                <!-- User Info & Logout -->
                <div class="p-4 border-t border-secondary-200">
                    <div class="flex items-center mb-3">
                        <img src="<?php echo e(auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name)); ?>"
                            alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                        <div class="flex-1">
                            <div class="text-sm font-medium text-secondary-900"><?php echo e(auth()->user()->name); ?></div>
                            <div class="text-xs text-secondary-500"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
                        </div>
                    </div>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full btn btn-secondary text-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="lg:pl-64">
            <!-- Top Bar (Mobile) -->
            <header class="bg-white border-b border-secondary-200 lg:hidden">
                <div class="flex items-center justify-between px-4 py-3">
                    <h1 class="text-lg font-bold text-primary-600">Sistem Absensi</h1>
                    <button class="p-2 rounded-lg hover:bg-secondary-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                <?php echo e($slot); ?>

            </main>
        </div>
    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html><?php /**PATH C:\Users\putri\Documents\Project\Bored\wengset-absensi\resources\views/layouts/app.blade.php ENDPATH**/ ?>