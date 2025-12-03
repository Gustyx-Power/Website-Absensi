<div>
    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-secondary-900">Kelola Admin</h1>
                <p class="text-secondary-600 mt-1">Promote karyawan menjadi admin atau demote admin</p>
            </div>
            <button wire:click="openCreateModal" class="btn btn-primary flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Admin
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-success-50 border border-success-200 rounded-lg">
            <p class="text-success-600 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-danger-50 border border-danger-200 rounded-lg">
            <p class="text-danger-600 font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Owner Info Card -->
    @if($owner)
        <div class="card mb-6 border-2 border-primary-200 bg-primary-50">
            <div class="card-body">
                <div class="flex items-center">
                    <img src="{{ $owner->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($owner->name) }}"
                        alt="Avatar" class="w-16 h-16 rounded-full mr-4 border-4 border-white shadow-lg">
                    <div class="flex-1">
                        <div class="flex items-center">
                            <h3 class="text-lg font-bold text-secondary-900 mr-2">{{ $owner->name }}</h3>
                            <span class="badge bg-primary-600 text-white">👑 Owner</span>
                        </div>
                        <p class="text-secondary-600 text-sm">{{ $owner->email }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-secondary-500">Role tidak dapat diubah</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Search -->
    <div class="card mb-6">
        <div class="card-body">
            <label class="form-label">Cari Admin</label>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nama atau email..."
                class="form-input">
        </div>
    </div>

    <!-- Admin List -->
    <div class="card">
        <div class="card-header flex items-center justify-between">
            <h2 class="text-lg font-semibold text-secondary-900">Daftar Admin ({{ $admins->total() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50 border-b border-secondary-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Admin</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Department</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Sejak</th>
                        <th
                            class="px-6 py-3 text-right text-xs font-medium text-secondary-600 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-secondary-200">
                    @forelse($admins as $admin)
                        <tr class="hover:bg-secondary-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $admin->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($admin->name) }}"
                                        alt="Avatar" class="w-10 h-10 rounded-full mr-3">
                                    <div>
                                        <div class="text-sm font-medium text-secondary-900">{{ $admin->name }}</div>
                                        <div class="text-xs text-secondary-500">ID: {{ $admin->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-900">
                                {{ $admin->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-600">
                                {{ $admin->department ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-500">
                                {{ $admin->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <button wire:click="demoteAdmin({{ $admin->id }})"
                                    wire:confirm="Apakah Anda yakin ingin demote {{ $admin->name }} kembali ke Employee?"
                                    class="text-danger-600 hover:text-danger-900 font-medium">
                                    Demote ke Employee
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-secondary-500">
                                Belum ada Admin. Klik "Tambah Admin" untuk promote karyawan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-secondary-200">
            {{ $admins->links() }}
        </div>
    </div>

    <!-- Create Modal (Promote to Admin) -->
    @if($showCreateModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" wire:click="closeModal">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4" wire:click.stop>
                <div class="card-header">
                    <h2 class="text-xl font-bold text-secondary-900">Promote ke Admin</h2>
                </div>
                <form wire:submit.prevent="promoteToAdmin">
                    <div class="card-body space-y-4">
                        <div class="bg-primary-50 border border-primary-200 rounded-lg p-4">
                            <p class="text-sm text-primary-900">
                                <strong>Cara:</strong> Masukkan email karyawan yang sudah terdaftar di sistem.
                                Karyawan tersebut akan dipromote menjadi Admin dan mendapat akses penuh ke Dashboard Admin.
                            </p>
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label class="form-label">Email Karyawan</label>
                            <input type="email" wire:model="userEmail" placeholder="contoh@gmail.com" class="form-input"
                                required>
                            @error('userEmail') <span class="form-error">{{ $message }}</span> @enderror
                        </div>

                        <div class="bg-warning-50 border border-warning-200 rounded-lg p-4">
                            <p class="text-xs text-warning-900">
                                ⚠️ Admin yang dipromote akan dapat mengelola data karyawan dan melihat semua laporan.
                                Pastikan orang yang tepat!
                            </p>
                        </div>
                    </div>
                    <div class="card-body border-t border-secondary-200 flex justify-end space-x-3">
                        <button type="button" wire:click="closeModal" class="btn btn-secondary">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Promote ke Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>