<?php

namespace App\Helpers;

/**
 * Distance Helper
 * 
 * Helper untuk menghitung jarak antara dua koordinat GPS menggunakan Haversine Formula.
 * Digunakan untuk validasi radius check-in/check-out karyawan.
 */
class DistanceHelper
{
    /** 
     * Radius bumi dalam meter 
     */
    private const EARTH_RADIUS_METERS = 6371000;

    /**
     * Calculate jarak antara dua koordinat menggunakan Haversine Formula
     * 
     * @param float $lat1 Latitude titik pertama
     * @param float $lon1 Longitude titik pertama
     * @param float $lat2 Latitude titik kedua
     * @param float $lon2 Longitude titik kedua
     * @return float Jarak dalam meter
     */
    public static function calculate(
        float $lat1,
        float $lon1,
        float $lat2,
        float $lon2
    ): float {
        // Convert degrees to radians
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        // Haversine Formula
        $deltaLat = $lat2Rad - $lat1Rad;
        $deltaLon = $lon2Rad - $lon1Rad;

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
            cos($lat1Rad) * cos($lat2Rad) *
            sin($deltaLon / 2) * sin($deltaLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Distance dalam meter
        $distance = self::EARTH_RADIUS_METERS * $c;

        return round($distance, 2);
    }

    /**
     * Check apakah koordinat berada dalam radius tertentu dari titik pusat
     * 
     * @param float $centerLat Latitude titik pusat (kantor)
     * @param float $centerLon Longitude titik pusat (kantor)
     * @param float $userLat Latitude user
     * @param float $userLon Longitude user
     * @param float $radius Radius dalam meter
     * @return bool True jika dalam radius, false jika di luar
     */
    public static function isWithinRadius(
        float $centerLat,
        float $centerLon,
        float $userLat,
        float $userLon,
        float $radius
    ): bool {
        $distance = self::calculate($centerLat, $centerLon, $userLat, $userLon);
        return $distance <= $radius;
    }

    /**
     * Format distance ke string yang mudah dibaca
     * 
     * @param float $meters Jarak dalam meter
     * @return string Formatted distance (contoh: "25.5 m" atau "1.2 km")
     */
    public static function format(float $meters): string
    {
        if ($meters >= 1000) {
            return number_format($meters / 1000, 2) . ' km';
        }
        return number_format($meters, 1) . ' m';
    }
}
