<div>
    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-secondary-900">Laporan Absensi</h1>
                <p class="text-secondary-600 mt-1">Export dan analisa data absensi</p>
            </div>
            <button wire:click="exportExcel" 
                    class="btn btn-success flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Excel
            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-6">
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Start Date -->
                <div>
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" 
                           wire:model.live="startDate"
                           class="form-input">
                </div>

                <!-- End Date -->
                <div>
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" 
                           wire:model.live="endDate"
                           class="form-input">
                </div>

                <!-- Employee Filter -->
                <div>
                    <label class="form-label">Karyawan</label>
                    <select wire:model.live="filterUserId" class="form-input">
                        <option value="">Semua Karyawan</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($emp->id); ?>"><?php echo e($emp->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <!-- Department Filter -->
                <div>
                    <label class="form-label">Department</label>
                    <select wire:model.live="filterDepartment" class="form-input">
                        <option value="">Semua Department</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($dept); ?>"><?php echo e($dept); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="form-label">Status</label>
                    <select wire:model.live="filterStatus" class="form-input">
                        <option value="">Semua Status</option>
                        <option value="on_time">Tepat Waktu</option>
                        <option value="late">Terlambat</option>
                        <option value="early_leave">Pulang Cepat</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50 border-b border-secondary-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Karyawan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Jarak</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Lokasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-secondary-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-secondary-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="<?php echo e($attendance->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($attendance->user->name)); ?>" 
                                         alt="Avatar" 
                                         class="w-8 h-8 rounded-full mr-3">
                                    <div>
                                        <div class="text-sm font-medium text-secondary-900"><?php echo e($attendance->user->name); ?></div>
                                        <div class="text-xs text-secondary-500"><?php echo e($attendance->user->department ?? '-'); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm <?php echo e($attendance->type === 'check_in' ? 'text-primary-600 font-medium' : 'text-secondary-600'); ?>">
                                    <?php echo e($attendance->type === 'check_in' ? 'Check-In' : 'Check-Out'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-900">
                                <?php echo e($attendance->created_at->format('d M Y')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-900">
                                <?php echo e($attendance->created_at->format('H:i')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="badge <?php echo e($attendance->status_badge_class); ?>">
                                    <?php echo e($attendance->status_label); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-600">
                                <?php echo e($attendance->formatted_distance); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-secondary-500">
                                <?php echo e(number_format($attendance->latitude, 4)); ?>, <?php echo e(number_format($attendance->longitude, 4)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-secondary-500">
                                Tidak ada data absensi untuk filter yang dipilih
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-secondary-200">
            <?php echo e($attendances->links()); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\Users\putri\Documents\Project\Bored\wengset-absensi\resources\views/livewire/admin/attendance-report.blade.php ENDPATH**/ ?>