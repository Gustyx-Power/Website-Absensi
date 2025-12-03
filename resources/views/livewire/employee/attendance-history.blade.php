<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 pt-8 pb-6">
        <h1 class="text-2xl font-bold mb-2">Riwayat Absensi</h1>
        <p class="text-primary-100">Track kehadiran Anda</p>
    </div>

    <div class="px-4 -mt-4">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-3 gap-3 mb-6">
            <div class="card p-4">
                <p class="text-xs text-secondary-600 mb-1">Total</p>
                <p class="text-xl font-bold text-primary-600">{{ $thisMonthCheckIns }}</p>
            </div>
            <div class="card p-4">
                <p class="text-xs text-secondary-600 mb-1">Tepat Waktu</p>
                <p class="text-xl font-bold text-success-600">{{ $thisMonthOnTime }}</p>
            </div>
            <div class="card p-4">
                <p class="text-xs text-secondary-600 mb-1">Terlambat</p>
                <p class="text-xl font-bold text-danger-600">{{ $thisMonthLate }}</p>
            </div>
        </div>

        <!-- Month Filter -->
        <div class="mb-4">
            <label class="form-label">Filter Bulan</label>
            <input type="month" wire:model.live="filterMonth" class="form-input">
        </div>

        <!-- Attendance List -->
        <div class="space-y-3">
            @forelse($attendances as $attendance)
                <div class="card p-4">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <p class="font-medium text-secondary-900">
                                {{ $attendance->created_at->isoFormat('dddd, D MMMM YYYY') }}</p>
                            <p class="text-sm text-secondary-600">{{ $attendance->created_at->format('H:i') }} WIB</p>
                        </div>
                        <span class="badge {{ $attendance->status_badge_class }}">
                            {{ $attendance->status_label }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-secondary-100">
                        <div class="flex items-center text-sm text-secondary-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            {{ $attendance->formatted_distance }}
                        </div>
                        <span
                            class="text-xs font-medium {{ $attendance->type === 'check_in' ? 'text-primary-600' : 'text-secondary-600' }}">
                            {{ $attendance->type === 'check_in' ? 'Check-In' : 'Check-Out' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="card p-8 text-center">
                    <p class="text-secondary-500">Tidak ada data absensi</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $attendances->links() }}
        </div>
    </div>
</div>