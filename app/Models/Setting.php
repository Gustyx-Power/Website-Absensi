<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    /**
     * Get setting value by key (dengan cache)
     */
    public static function get(string $key, $default = null)
    {
        return Cache::remember("setting:{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set setting value by key
     */
    public static function set(string $key, $value, string $description = null): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'description' => $description,
            ]
        );

        // Clear cache
        Cache::forget("setting:{$key}");
    }

    /**
     * Get koordinat kantor (latitude)
     */
    public static function getOfficeLatitude(): float
    {
        return (float) static::get('office_latitude', env('OFFICE_LATITUDE', -6.200000));
    }

    /**
     * Get koordinat kantor (longitude)
     */
    public static function getOfficeLongitude(): float
    {
        return (float) static::get('office_longitude', env('OFFICE_LONGITUDE', 106.816666));
    }

    /**
     * Get radius absensi (dalam meter)
     */
    public static function getAttendanceRadius(): float
    {
        return (float) static::get('attendance_radius', env('ATTENDANCE_RADIUS', 50));
    }

    /**
     * Get jam mulai kerja (format: HH:MM)
     */
    public static function getWorkStartTime(): string
    {
        return static::get('work_start_time', '08:00');
    }

    /**
     * Get jam selesai kerja (format: HH:MM)
     */
    public static function getWorkEndTime(): string
    {
        return static::get('work_end_time', '17:00');
    }
}
