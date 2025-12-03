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
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Department Filter -->
                <div>
                    <label class="form-label">Department</label>
                    <select wire:model.live="filterDepartment" class="form-input">
                        <option value="">Semua Department</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept }}">{{ $dept }}</option>
                        @endforeach
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
                    @forelse($attendances as $attendance)
                        <tr class="hover:bg-secondary-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img src="{{ $attendance->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($attendance->user->name) }}" 
                                         alt="Avatar" 
                                         class="w-8 h-8 rounded-full mr-3">
                                    <div>
                                        <div class="text-sm font-medium text-secondary-900">{{ $attendance->user->name }}</div>
                                        <div class="text-xs text-secondary-500">{{ $attendance->user->department ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm {{ $attendance->type === 'check_in' ? 'text-primary-600 font-medium' : 'text-secondary-600' }}">
                                    {{ $attendance->type === 'check_in' ? 'Check-In' : 'Check-Out' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-900">
                                {{ $attendance->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-900">
                                {{ $attendance->created_at->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="badge {{ $attendance->status_badge_class }}">
                                    {{ $attendance->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-600">
                                {{ $attendance->formatted_distance }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-secondary-500">
                                {{ number_format($attendance->latitude, 4) }}, {{ number_format($attendance->longitude, 4) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-secondary-500">
                                Tidak ada data absensi untuk filter yang dipilih
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-secondary-200">
            {{ $attendances->links() }}
        </div>
    </div>
</div>
