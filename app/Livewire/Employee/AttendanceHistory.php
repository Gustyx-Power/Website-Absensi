<?php

namespace App\Livewire\Employee;

use App\Models\Attendance;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceHistory extends Component
{
    use WithPagination;

    public $searchDate;
    public $filterMonth;

    /**
     * Mount component
     */
    public function mount()
    {
        $this->filterMonth = now()->format('Y-m');
    }

    /**
     * Reset pagination saat filter berubah
     */
    public function updatingFilterMonth()
    {
        $this->resetPage();
    }

    /**
     * Render component
     */
    public function render()
    {
        $user = auth()->user();

        // Query attendances
        $query = Attendance::where('user_id', $user->id)
            ->orderBy('created_at', 'desc');

        // Filter by month
        if ($this->filterMonth) {
            $date = \Carbon\Carbon::createFromFormat('Y-m', $this->filterMonth);
            $query->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year);
        }

        $attendances = $query->paginate(20);

        // Statistics bulan ini
        $thisMonthCheckIns = Attendance::where('user_id', $user->id)
            ->checkIn()
            ->thisMonth()
            ->count();

        $thisMonthOnTime = Attendance::where('user_id', $user->id)
            ->checkIn()
            ->thisMonth()
            ->onTime()
            ->count();

        $thisMonthLate = Attendance::where('user_id', $user->id)
            ->checkIn()
            ->thisMonth()
            ->late()
            ->count();

        return view('livewire.employee.attendance-history', [
            'attendances' => $attendances,
            'thisMonthCheckIns' => $thisMonthCheckIns,
            'thisMonthOnTime' => $thisMonthOnTime,
            'thisMonthLate' => $thisMonthLate,
        ])->layout('layouts.mobile');
    }
}
