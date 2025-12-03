<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'avatar',
        'department',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke attendances
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Check apakah user adalah Owner (Dewa)
     */
    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    /**
     * Check apakah user adalah Admin (HRD)
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check apakah user adalah Employee (Karyawan)
     */
    public function isEmployee(): bool
    {
        return $this->role === 'employee';
    }

    /**
     * Check apakah user punya akses admin (Owner atau Admin)
     */
    public function hasAdminAccess(): bool
    {
        return in_array($this->role, ['owner', 'admin']);
    }

    /**
     * Get attendance hari ini untuk user
     */
    public function getTodayCheckIn()
    {
        return $this->attendances()
            ->where('type', 'check_in')
            ->whereDate('created_at', today())
            ->first();
    }

    /**
     * Get attendance check-out hari ini untuk user
     */
    public function getTodayCheckOut()
    {
        return $this->attendances()
            ->where('type', 'check_out')
            ->whereDate('created_at', today())
            ->first();
    }

    /**
     * Check apakah user sudah check-in hari ini
     */
    public function hasCheckedInToday(): bool
    {
        return $this->getTodayCheckIn() !== null;
    }

    /**
     * Check apakah user sudah check-out hari ini
     */
    public function hasCheckedOutToday(): bool
    {
        return $this->getTodayCheckOut() !== null;
    }
}
