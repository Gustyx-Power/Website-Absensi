<?php

namespace App\Livewire\Admin;

use App\Models\Attendance;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    /**
     * Render dashboard dengan statistics dan chart data
     */
    public function render()
    {
        // Summary Cards Data
        $totalEmployees = User::where('role', 'employee')->count();
        $todayAttendance = Attendance::today()->checkIn()->distinct('user_id')->count('user_id');
        $todayLate = Attendance::today()->checkIn()->late()->count();
        $thisMonthOnTime = Attendance::thisMonth()->checkIn()->onTime()->count();

        // Line Chart Data: Attendance Trend (7 hari terakhir)
        $trendData = $this->getAttendanceTrendData();

        // Pie Chart Data: On Time vs Late (bulan ini)
        $onTimeVsLateData = $this->getOnTimeVsLateData();

        // Recent Attendances (10 terakhir)
        $recentAttendances = Attendance::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('livewire.admin.dashboard', [
            'totalEmployees' => $totalEmployees,
            'todayAttendance' => $todayAttendance,
            'todayLate' => $todayLate,
            'thisMonthOnTime' => $thisMonthOnTime,
            'trendData' => $trendData,
            'onTimeVsLateData' => $onTimeVsLateData,
            'recentAttendances' => $recentAttendances,
        ])->layout('layouts.app');
    }

    /**
     * Get data untuk Line Chart: Attendance Trend (7 hari terakhir)
     */
    private function getAttendanceTrendData(): array
    {
        $dates = [];
        $checkInCounts = [];
        $checkOutCounts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dates[] = $date->format('d M');

            $checkInCounts[] = Attendance::whereDate('created_at', $date)
                ->checkIn()
                ->count();

            $checkOutCounts[] = Attendance::whereDate('created_at', $date)
                ->checkOut()
                ->count();
        }

        return [
            'categories' => $dates,
            'series' => [
                [
                    'name' => 'Check-In',
                    'data' => $checkInCounts,
                ],
                [
                    'name' => 'Check-Out',
                    'data' => $checkOutCounts,
                ],
            ],
        ];
    }

    /**
     * Get data untuk Pie Chart: On Time vs Late (bulan ini)
     */
    private function getOnTimeVsLateData(): array
    {
        $onTime = Attendance::thisMonth()->checkIn()->onTime()->count();
        $late = Attendance::thisMonth()->checkIn()->late()->count();

        return [
            'labels' => ['Tepat Waktu', 'Terlambat'],
            'series' => [$onTime, $late],
            'colors' => ['#22c55e', '#ef4444'], // Green for on-time, Red for late
        ];
    }
}
