

<?php $__env->startSection('content'); ?>
<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 pt-8 pb-32">
        <h1 class="text-2xl font-bold mb-2">Profil Saya</h1>
        <p class="text-primary-100">Informasi akun Anda</p>
    </div>

    <div class="px-4 -mt-24">
        <!-- Profile Card -->
        <div class="card p-6 mb-6">
            <div class="flex flex-col items-center text-center mb-6">
                <img src="<?php echo e(auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&size=200'); ?>"
                    alt="Avatar" class="w-32 h-32 rounded-full mb-4 border-4 border-white shadow-lg">
                <h2 class="text-2xl font-bold text-secondary-900"><?php echo e(auth()->user()->name); ?></h2>
                <p class="text-secondary-600 mt-1"><?php echo e(auth()->user()->email); ?></p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->department): ?>
                    <span class="badge bg-primary-100 text-primary-600 mt-2"><?php echo e(auth()->user()->department); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Info Boxes -->
            <div class="space-y-3 pt-6 border-t border-secondary-200">
                <div class="flex items-center justify-between py-3">
                    <span class="text-secondary-600">Role</span>
                    <span class="font-medium text-secondary-900"><?php echo e(ucfirst(auth()->user()->role)); ?></span>
                </div>
                <div class="flex items-center justify-between py-3 border-t border-secondary-100">
                    <span class="text-secondary-600">Terdaftar Sejak</span>
                    <span
                        class="font-medium text-secondary-900"><?php echo e(auth()->user()->created_at->format('d M Y')); ?></span>
                </div>
                <?php if(auth()->user()->email_verified_at): ?>
                    <div class="flex items-center justify-between py-3 border-t border-secondary-100">
                        <span class="text-secondary-600">Email Verified</span>
                        <span class="badge badge-success">✓ Verified</span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Statistics This Month -->
        <div class="card p-6 mb-6">
            <h3 class="text-lg font-bold text-secondary-900 mb-4">Statistik Bulan Ini</h3>
            <div class="grid grid-cols-3 gap-4">
                <?php
                    $totalCheckIns = auth()->user()->attendances()->checkIn()->thisMonth()->count();
                    $onTimeCount = auth()->user()->attendances()->checkIn()->thisMonth()->onTime()->count();
                    $lateCount = auth()->user()->attendances()->checkIn()->thisMonth()->late()->count();
                ?>
                <div class="text-center">
                    <p class="text-3xl font-bold text-primary-600"><?php echo e($totalCheckIns); ?></p>
                    <p class="text-xs text-secondary-600 mt-1">Total Absen</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-success-600"><?php echo e($onTimeCount); ?></p>
                    <p class="text-xs text-secondary-600 mt-1">Tepat Waktu</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-danger-600"><?php echo e($lateCount); ?></p>
                    <p class="text-xs text-secondary-600 mt-1">Terlambat</p>
                </div>
            </div>
        </div>

        <!-- Info Note -->
        <div class="card p-4 mb-6 bg-primary-50 border-primary-200">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="text-sm text-primary-900 font-medium mb-1">Informasi</p>
                    <p class="text-xs text-primary-700">
                        Data profil (Nama & Foto) disinkronkan otomatis dari Google.
                        Jika perlu mengubah email atau department, hubungi Admin/HRD.
                    </p>
                </div>
            </div>
        </div>

        <!-- Logout Button -->
        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full btn btn-danger py-4 flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>
<?php echo $__env->make('layouts.mobile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\putri\Documents\Project\Bored\wengset-absensi\resources\views/employee/profile.blade.php ENDPATH**/ ?>