<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'type',
        'photo',
        'latitude',
        'longitude',
        'distance',
        'status',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'distance' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope query untuk check-in
     */
    public function scopeCheckIn($query)
    {
        return $query->where('type', 'check_in');
    }

    /**
     * Scope query untuk check-out
     */
    public function scopeCheckOut($query)
    {
        return $query->where('type', 'check_out');
    }

    /**
     * Scope query untuk hari ini
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope query untuk bulan ini
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
    }

    /**
     * Scope query untuk on-time attendance
     */
    public function scopeOnTime($query)
    {
        return $query->where('status', 'on_time');
    }

    /**
     * Scope query untuk late attendance
     */
    public function scopeLate($query)
    {
        return $query->where('status', 'late');
    }

    /**
     * Get formatted distance (contoh: "25.5 m" atau "1.2 km")
     */
    public function getFormattedDistanceAttribute(): string
    {
        if ($this->distance >= 1000) {
            return number_format($this->distance / 1000, 2) . ' km';
        }
        return number_format($this->distance, 1) . ' m';
    }

    /**
     * Get badge class untuk status
     */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'on_time' => 'badge-success',
            'late' => 'badge-danger',
            'early_leave' => 'badge-warning',
            default => 'badge-secondary',
        };
    }

    /**
     * Get status label dalam Bahasa Indonesia
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'on_time' => 'Tepat Waktu',
            'late' => 'Terlambat',
            'early_leave' => 'Pulang Cepat',
            default => 'Unknown',
        };
    }
}
