<div>
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-secondary-900">Data Karyawan</h1>
        <p class="text-secondary-600 mt-1">Kelola data karyawan</p>
    </div>

    <!-- Flash Messages -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
        <div class="mb-4 p-4 bg-success-50 border border-success-200 rounded-lg">
            <p class="text-success-600 font-medium"><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(session()->has('error')): ?>
        <div class="mb-4 p-4 bg-danger-50 border border-danger-200 rounded-lg">
            <p class="text-danger-600 font-medium"><?php echo e(session('error')); ?></p>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Filters -->
    <div class="card mb-6">
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Search -->
                <div>
                    <label class="form-label">Cari Karyawan</label>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nama atau email..."
                        class="form-input">
                </div>

                <!-- Department Filter -->
                <div>
                    <label class="form-label">Filter Department</label>
                    <select wire:model.live="filterDepartment" class="form-input">
                        <option value="">Semua Department</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($dept); ?>"><?php echo e($dept); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50 border-b border-secondary-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Karyawan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Status</th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-secondary-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-secondary-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="<?php echo e($employee->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($employee->name)); ?>"
                                        alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <div class="text-sm font-medium text-secondary-900"><?php echo e($employee->name); ?></div>
                                        <div class="text-xs text-secondary-500">ID: <?php echo e($employee->id); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-900">
                                <?php echo e($employee->email); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-600">
                                <?php echo e($employee->department ?? '-'); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($employee->hasCheckedInToday()): ?>
                                    <span class="badge badge-success">Sudah Absen</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-100 text-secondary-600">Belum Absen</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <button wire:click="edit(<?php echo e($employee->id); ?>)"
                                    class="text-primary-600 hover:text-primary-900 font-medium">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-secondary-500">
                                Tidak ada data karyawan
                            </td>
                        </tr>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-secondary-200">
            <?php echo e($employees->links()); ?>

        </div>
    </div>

    <!-- Edit Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showEditModal): ?>
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click="closeModal">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4" wire:click.stop>
                <div class="card-header">
                    <h2 class="text-xl font-bold text-secondary-900">Edit Karyawan</h2>
                </div>
                <form wire:submit.prevent="updateEmployee">
                    <div class="card-body space-y-4">
                        <!-- Name (Read-only) -->
                        <div>
                            <label class="form-label">Nama</label>
                            <input type="text" value="<?php echo e($editingUser->name); ?>" disabled
                                class="form-input bg-secondary-100">
                            <p class="text-xs text-secondary-500 mt-1">Nama disinkronkan dari Google, tidak bisa diedit
                                manual</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="form-label">Email</label>
                            <input type="email" wire:model="editEmail" class="form-input">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editEmail'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="form-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <!-- Department -->
                        <div>
                            <label class="form-label">Department</label>
                            <input type="text" wire:model="editDepartment" placeholder="Contoh: Engineering, Marketing"
                                class="form-input">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['editDepartment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="form-error"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body border-t border-secondary-200 flex justify-end space-x-3">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH C:\Users\putri\Documents\Project\Bored\wengset-absensi\resources\views/livewire/admin/employee-management.blade.php ENDPATH**/ ?>