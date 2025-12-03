<div>
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-secondary-900">Dashboard</h1>
        <p class="text-secondary-600 mt-1">Overview absensi karyawan</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Employees -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary-600 mb-1">Total Karyawan</p>
                        <p class="text-3xl font-bold text-primary-600"><?php echo e($totalEmployees); ?></p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today Attendance -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary-600 mb-1">Absen Hari Ini</p>
                        <p class="text-3xl font-bold text-success-600"><?php echo e($todayAttendance); ?></p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-success-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Late Today -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary-600 mb-1">Terlambat Hari Ini</p>
                        <p class="text-3xl font-bold text-danger-600"><?php echo e($todayLate); ?></p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-danger-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-danger-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- On Time This Month -->
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary-600 mb-1">Tepat Waktu (Bulan Ini)</p>
                        <p class="text-3xl font-bold text-primary-600"><?php echo e($thisMonthOnTime); ?></p>
                    </div>
                    <div class="w-12 h-12 rounded-full bg-primary-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Line Chart: Attendance Trend -->
        <div class="card">
            <div class="card-header">
                <h2 class="text-lg font-semibold text-secondary-900">Tren Absensi (7 Hari Terakhir)</h2>
            </div>
            <div class="card-body">
                <div id="attendance-trend-chart"></div>
            </div>
        </div>

        <!-- Pie Chart: On Time vs Late -->
        <div class="card">
            <div class="card-header">
                <h2 class="text-lg font-semibold text-secondary-900">Ketepatan Waktu (Bulan Ini)</h2>
            </div>
            <div class="card-body">
                <div id="ontime-late-chart"></div>
            </div>
        </div>
    </div>

    <!-- Recent Attendances -->
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-semibold text-secondary-900">Absensi Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-secondary-50 border-b border-secondary-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Karyawan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-secondary-600 uppercase tracking-wider">Jarak</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-secondary-200">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $recentAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                <?php echo e($attendance->created_at->format('d M Y, H:i')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="badge <?php echo e($attendance->status_badge_class); ?>">
                                    <?php echo e($attendance->status_label); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary-600">
                                <?php echo e($attendance->formatted_distance); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ApexCharts Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Line Chart: Attendance Trend
        var trendOptions = {
            series: <?php echo json_encode($trendData['series'], 15, 512) ?>,
            chart: {
                type: 'line',
                height: 300,
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif',
            },
            colors: ['#2563eb', '#64748b'],
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: 3,
            },
            xaxis: {
                categories: <?php echo json_encode($trendData['categories'], 15, 512) ?>,
            },
            yaxis: {
                title: { text: 'Jumlah' },
            },
            legend: {
                position: 'top',
            },
            grid: {
                borderColor: '#e2e8f0',
            },
        };
        var trendChart = new ApexCharts(document.querySelector("#attendance-trend-chart"), trendOptions);
        trendChart.render();

        // Pie Chart: On Time vs Late
        var pieOptions = {
            series: <?php echo json_encode($onTimeVsLateData['series'], 15, 512) ?>,
            chart: {
                type: 'pie',
                height: 300,
                fontFamily: 'Inter, sans-serif',
            },
            labels: <?php echo json_encode($onTimeVsLateData['labels'], 15, 512) ?>,
            colors: <?php echo json_encode($onTimeVsLateData['colors'], 15, 512) ?>,
            legend: {
                position: 'bottom',
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return Math.round(val) + '%';
                },
            },
        };
        var pieChart = new ApexCharts(document.querySelector("#ontime-late-chart"), pieOptions);
        pieChart.render();
    </script>
</div>
<?php /**PATH C:\Users\putri\Documents\Project\Bored\wengset-absensi\resources\views/livewire/admin/dashboard.blade.php ENDPATH**/ ?>