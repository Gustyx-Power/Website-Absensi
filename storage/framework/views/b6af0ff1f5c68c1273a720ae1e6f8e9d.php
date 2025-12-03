<div>
    <!-- Header -->
    <div class="bg-gradient-to-r from-primary-600 to-primary-700 text-white px-6 pt-8 pb-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h1 class="text-2xl font-bold">Absensi Hari Ini</h1>
                <p class="text-primary-100 mt-1"><?php echo e(now()->isoFormat('dddd, D MMMM YYYY')); ?></p>
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
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session()->has('success')): ?>
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600 font-medium"><?php echo e(session('success')); ?></p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(session()->has('error')): ?>
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-red-600 font-medium"><?php echo e(session('error')); ?></p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <!-- Status Cards -->
        <div class="grid grid-cols-2 gap-3 mb-6">
            <!-- Check-In Status -->
            <div class="card p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs text-secondary-600">Check-In</span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayCheckIn): ?>
                        <span class="badge badge-success">✓</span>
                    <?php else: ?>
                        <span class="badge bg-secondary-100 text-secondary-600">-</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <p class="text-lg font-bold text-secondary-900">
                    <?php echo e($todayCheckIn ? $todayCheckIn->created_at->format('H:i') : '--:--'); ?>

                </p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayCheckIn): ?>
                    <span class="badge <?php echo e($todayCheckIn->status_badge_class); ?> text-xs mt-1">
                        <?php echo e($todayCheckIn->status_label); ?>

                    </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Check-Out Status -->
            <div class="card p-4">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs text-secondary-600">Check-Out</span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($todayCheckOut): ?>
                        <span class="badge badge-success">✓</span>
                    <?php else: ?>
                        <span class="badge bg-secondary-100 text-secondary-600">-</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <p class="text-lg font-bold text-secondary-900">
                    <?php echo e($todayCheckOut ? $todayCheckOut->created_at->format('H:i') : '--:--'); ?>

                </p>
            </div>
        </div>

        <!-- Main Form -->
        <div class="card p-6">
            <h2 class="text-lg font-bold text-secondary-900 mb-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$todayCheckIn): ?>
                    📸 Check-In Sekarang
                <?php elseif(!$todayCheckOut): ?>
                    🏠 Check-Out Sekarang
                <?php else: ?>
                    ✅ Absensi Hari Ini Selesai
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </h2>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$todayCheckIn || !$todayCheckOut): ?>
                <form wire:submit.prevent="submit">
                    <!-- Camera Input -->
                    <div class="mb-6">
                        <label class="form-label mb-3 block">
                            <span class="flex items-center text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Foto Selfie (Wajib dari Kamera)
                            </span>
                        </label>
                        
                        <!-- Camera Capture Interface -->
                        <div class="space-y-3">
                            <!-- Start Camera Button -->
                            <button type="button" id="startCamera" 
                                    class="w-full px-6 py-4 bg-blue-600 text-white text-lg rounded-xl font-bold hover:bg-blue-700 active:bg-blue-800 transition-all duration-200 flex items-center justify-center shadow-lg">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                📹 Buka Kamera
                            </button>

                            <!-- Camera Preview (hidden by default) -->
                            <div id="cameraContainer" class="hidden space-y-3">
                                <div class="relative rounded-xl overflow-hidden shadow-2xl border-4 border-blue-500">
                                    <video id="videoPreview" autoplay playsinline class="w-full" style="transform: scaleX(-1); max-height: 400px;"></video>
                                </div>
                                <button type="button" id="capturePhoto"
                                        class="w-full px-6 py-4 bg-green-600 text-white text-lg rounded-xl font-bold hover:bg-green-700 active:bg-green-800 transition-all duration-200 flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    </svg>
                                    📸 Ambil Foto
                                </button>
                            </div>

                            <!-- Canvas for capture (hidden) -->
                            <canvas id="photoCanvas" class="hidden"></canvas>

                            <!-- Photo Preview -->
                            <div id="photoPreview" class="hidden space-y-3">
                                <div class="relative rounded-xl overflow-hidden shadow-2xl">
                                    <img id="capturedImage" src="" class="w-full border-4 border-green-500" alt="Preview" style="max-height: 400px; object-fit: cover;">
                                    <div class="absolute top-3 right-3 bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                        ✓ Foto Berhasil
                                    </div>
                                </div>
                                <button type="button" id="retakePhoto"
                                        class="w-full px-6 py-4 bg-orange-500 text-white text-lg rounded-xl font-bold hover:bg-orange-600 active:bg-orange-700 transition-all duration-200 flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    🔄 Ambil Ulang
                                </button>
                            </div>

                            <!-- Hidden input for Livewire -->
                            <input type="hidden" id="photoData" wire:model="photoBase64">
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['photoBase64'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- GPS Location (Auto-fetch) -->
                    <div class="mb-6">
                        <label class="form-label mb-3 block">
                            <span class="flex items-center text-sm font-medium text-gray-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Lokasi GPS
                            </span>
                        </label>
                        <div class="p-4 bg-gray-50 rounded-lg border-2 border-gray-200">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($latitude && $longitude): ?>
                                <p class="text-sm text-green-600 font-medium">✓ Lokasi terdeteksi</p>
                                <p class="text-xs text-gray-600 mt-1 font-mono"><?php echo e(number_format($latitude, 7)); ?>, <?php echo e(number_format($longitude, 7)); ?></p>
                            <?php else: ?>
                                <p class="text-sm text-gray-600">Menunggu GPS...</p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['latitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['longitude'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full btn btn-primary py-4 text-lg font-semibold"
                        wire:loading.attr="disabled" wire:loading.class="opacity-50">
                        <span wire:loading.remove>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$todayCheckIn): ?>
                                🚀 Check-In Sekarang
                            <?php else: ?>
                                🏁 Check-Out Sekarang
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </form>

                <!-- Camera & GPS Scripts -->
                <script>
                    let stream = null;
                    let videoElement = null;
                    let canvasElement = null;

                    document.addEventListener('DOMContentLoaded', function () {
                        // Get GPS location
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(
                                function (position) {
                                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('latitude', position.coords.latitude);
                                    window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('longitude', position.coords.longitude);
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

                        // Camera functionality
                        videoElement = document.getElementById('videoPreview');
                        canvasElement = document.getElementById('photoCanvas');

                        // Start Camera Button
                        document.getElementById('startCamera').addEventListener('click', async function() {
                            try {
                                stream = await navigator.mediaDevices.getUserMedia({
                                    video: { facingMode: 'user', width: 1280, height: 720 },
                                    audio: false
                                });
                                
                                videoElement.srcObject = stream;
                                document.getElementById('cameraContainer').classList.remove('hidden');
                                document.getElementById('startCamera').classList.add('hidden');
                            } catch (error) {
                                console.error('Camera Error:', error);
                                alert('Gagal mengakses kamera. Pastikan kamera aktif dan izinkan akses kamera.\n\nError: ' + error.message);
                            }
                        });

                        // Capture Photo Button
                        document.getElementById('capturePhoto').addEventListener('click', function() {
                            const context = canvasElement.getContext('2d');
                            canvasElement.width = videoElement.videoWidth;
                            canvasElement.height = videoElement.videoHeight;
                            
                            // Mirror the image back
                            context.translate(canvasElement.width, 0);
                            context.scale(-1, 1);
                            context.drawImage(videoElement, 0, 0);
                            
                            // Convert to base64
                            const photoData = canvasElement.toDataURL('image/jpeg', 0.8);
                            document.getElementById('photoData').value = photoData;
                            document.getElementById('capturedImage').src = photoData;
                            
                            // Update UI
                            document.getElementById('cameraContainer').classList.add('hidden');
                            document.getElementById('photoPreview').classList.remove('hidden');
                            
                            // Stop camera stream
                            if (stream) {
                                stream.getTracks().forEach(track => track.stop());
                            }

                            // Trigger Livewire update
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('photoBase64', photoData);
                        });

                        // Retake Photo Button
                        document.getElementById('retakePhoto').addEventListener('click', function() {
                            document.getElementById('photoPreview').classList.add('hidden');
                            document.getElementById('startCamera').classList.remove('hidden');
                            window.Livewire.find('<?php echo e($_instance->getId()); ?>').set('photoBase64', '');
                        });
                    });
                </script>
            <?php else: ?>
                <div class="text-center py-8">
                    <div class="text-6xl mb-4">✅</div>
                    <p class="text-lg text-gray-600">Absensi hari ini sudah lengkap</p>
                    <p class="text-sm text-gray-500 mt-2">Terima kasih!</p>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div><?php /**PATH C:\Users\putri\Documents\Project\Bored\wengset-absensi\resources\views/livewire/employee/check-in.blade.php ENDPATH**/ ?>