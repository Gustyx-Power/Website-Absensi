<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $startDate;
    protected $endDate;
    protected $userId;
    protected $department;
    protected $status;

    public function __construct($startDate, $endDate, $userId = null, $department = null, $status = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->userId = $userId;
        $this->department = $department;
        $this->status = $status;
    }

    /**
     * Query data untuk export
     */
    public function collection()
    {
        $query = Attendance::with('user')
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }
        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }
        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }
        if ($this->department) {
            $query->whereHas('user', function ($q) {
                $q->where('department', $this->department);
            });
        }
        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->get();
    }

    /**
     * Headings untuk Excel
     */
    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'Email',
            'Department',
            'Tipe',
            'Waktu',
            'Status',
            'Jarak (meter)',
            'Latitude',
            'Longitude',
        ];
    }

    /**
     * Mapping data ke columns
     */
    public function map($attendance): array
    {
        return [
            $attendance->created_at->format('d/m/Y'),
            $attendance->user->name,
            $attendance->user->email,
            $attendance->user->department ?? '-',
            $attendance->type === 'check_in' ? 'Check-In' : 'Check-Out',
            $attendance->created_at->format('H:i:s'),
            $attendance->status_label,
            number_format($attendance->distance, 2),
            $attendance->latitude,
            $attendance->longitude,
        ];
    }

    /**
     * Styling untuk Excel header
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
