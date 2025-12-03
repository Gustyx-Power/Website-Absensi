<?php

namespace App\Livewire\Admin;

use App\Models\Attendance;
use App\Models\User;
use App\Exports\AttendanceExport;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceReport extends Component
{
    use WithPagination;

    public $startDate;
    public $endDate;
    public $filterUserId = '';
    public $filterDepartment = '';
    public $filterStatus = '';

    /**
     * Mount component dengan default date range (bulan ini)
     */
    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }

    /**
     * Reset pagination saat filter berubah
     */
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['startDate', 'endDate', 'filterUserId', 'filterDepartment', 'filterStatus'])) {
            $this->resetPage();
        }
    }

    /**
     * Export attendance report ke Excel
     */
    public function exportExcel()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ], [
            'startDate.required' => 'Tanggal mulai wajib diisi.',
            'endDate.required' => 'Tanggal akhir wajib diisi.',
            'endDate.after_or_equal' => 'Tanggal akhir harus setelah atau sama dengan tanggal mulai.',
        ]);

        $filename = 'attendance-report-' . $this->startDate . '-to-' . $this->endDate . '.xlsx';

        return Excel::download(
            new AttendanceExport($this->startDate, $this->endDate, $this->filterUserId, $this->filterDepartment, $this->filterStatus),
            $filename
        );
    }

    /**
     * Render component
     */
    public function render()
    {
        // Build query
        $query = Attendance::with('user')
            ->orderBy('created_at', 'desc');

        // Filter by date range
        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }
        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }

        // Filter by user
        if ($this->filterUserId) {
            $query->where('user_id', $this->filterUserId);
        }

        // Filter by department
        if ($this->filterDepartment) {
            $query->whereHas('user', function ($q) {
                $q->where('department', $this->filterDepartment);
            });
        }

        // Filter by status
        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        $attendances = $query->paginate(20);

        // Get all employees untuk filter dropdown
        $employees = User::where('role', 'employee')
            ->orderBy('name')
            ->get();

        // Get departments untuk filter
        $departments = User::where('role', 'employee')
            ->distinct()
            ->pluck('department')
            ->filter()
            ->sort();

        return view('livewire.admin.attendance-report', [
            'attendances' => $attendances,
            'employees' => $employees,
            'departments' => $departments,
        ])->layout('layouts.app');
    }
}
