<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 pt-8 pb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-2xl font-bold">Absensi Hari Ini</h1>
                <p class="text-primary-100 mt-1">{{ now()->isoFormat('dddd, D MMMM YYYY') }}</p>
            </div>
            <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="px-4 -mt-4">
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

        <!-- Status Cards -->
        <div class="grid grid-cols-2 gap-3 mb-6">
            <!-- Check-In Status -->
            <div class="card p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs text-secondary-600">Check-In</span>
                    @if($todayCheckIn)
                        <span class="badge badge-success">✓</span>
                    @else
                        <span class="badge bg-secondary-100 text-secondary-600">-</span>
                    @endif
                </div>
                <p class="text-lg font-bold text-secondary-900">
                    {{ $todayCheckIn ? $todayCheckIn->created_at->format('H:i') : '--:--' }}
                </p>
                @if($todayCheckIn)
                    <span class="badge {{ $todayCheckIn->status_badge_class }} text-xs mt-1">
                        {{ $todayCheckIn->status_label }}
                    </span>
                @endif
            </div>

            <!-- Check-Out Status -->
            <div class="card p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs text-secondary-600">Check-Out</span>
                    @if($todayCheckOut)
                        <span class="badge badge-success">✓</span>
                    @else
                        <span class="badge bg-secondary-100 text-secondary-600">-</span>
                    @endif
                </div>
                <p class="text-lg font-bold text-secondary-900">
                    {{ $todayCheckOut ? $todayCheckOut->created_at->format('H:i') : '--:--' }}
                </p>
            </div>
        </div>

        <!-- Main Form -->
        <div class="card p-6">
            <h2 class="text-lg font-bold text-secondary-900 mb-4">
                @if(!$todayCheckIn)
                    📸 Check-In Sekarang
                @elseif(!$todayCheckOut)
                    🏠 Check-Out Sekarang
                @else
                    ✅ Absensi Hari Ini Selesai
                @endif
            </h2>

            @if(!$todayCheckIn || !$todayCheckOut)
                <form wire:submit.prevent="submit">
                    <!-- Camera Input -->
                    <div class="mb-6">
                        <label class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Foto Selfie
                            </span>
                        </label>
                        <input type="file" accept="image/*" capture="user" wire:model="photo"
                            class="w-full px-4 py-3 border border-secondary-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        @error('photo') <span class="form-error">{{ $message }}</span> @enderror

                        @if ($photo)
                            <div class="mt-3">
                                <img src="{{ $photo->temporaryUrl() }}" class="w-full rounded-lg" alt="Preview">
                            </div>
                        @endif
                    </div>

                    <!-- GPS Location (Auto-fetch) -->
                    <div class="mb-6">
                        <label class="form-label">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Lokasi GPS
                            </span>
                        </label>
                        <div class="p-4 bg-secondary-50 rounded-lg">
                            @if($latitude && $longitude)
                                <p class="text-sm text-success-600 font-medium">✓ Lokasi terdeteksi</p>
                                <p class="text-xs text-secondary-600 mt-1">{{ number_format($latitude, 6) }},
                                    {{ number_format($longitude, 6) }}</p>
                            @else
                                <p class="text-sm text-secondary-600">Menunggu GPS...</p>
                            @endif
                        </div>
                        @error('latitude') <span class="form-error">{{ $message }}</span> @enderror
                        @error('longitude') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full btn btn-primary py-4 text-lg font-semibold"
                        wire:loading.attr="disabled" wire:loading.class="opacity-50">
                        <span wire:loading.remove>
                            @if(!$todayCheckIn)
                                🚀 Check-In Sekarang
                            @else
                                🏁 Check-Out Sekarang
                            @endif
                        </span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </form>

                <!-- Auto GPS Fetch Script -->
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                                function (position) {
                                    @this.set('latitude', position.coords.latitude);
                                    @this.set('longitude', position.coords.longitude);
                                },
                                function (error) {
                                    console.error('GPS Error:', error);
                                    alert('Gagal mendapatkan lokasi GPS. Pastikan GPS aktif dan izinkan akses lokasi.');
                                },
                                {
                                    enableHighAccuracy: true,
                                    timeout: 10000,
                                    maximumAge: 0
                                }
                            );
                        } else {
                            alert('Browser Anda tidak mendukung GPS.');
                        }
                    });
                </script>
            @endif
        </div>
    </div>
</div>