<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * 
     * Membuat 3 akun utama:
     * 1. Owner (Dewa) - gustiadityamuzaky08@gmail.com
     * 2. Admin (HRD) - gustiadityacreator07@gmail.com
     * 3. Employee (Contoh) - fajartergg@gmail.com
     */
    public function run(): void
    {
        // 1. Create Owner Account
        User::create([
            'name' => 'Gusti Owner',
            'email' => 'gustiadityamuzaky08@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Default password, akan diganti saat login Google
            'role' => 'owner',
            'google_id' => null,
            'avatar' => null,
            'department' => 'Management',
        ]);

        // 2. Create Admin/HRD Account
        User::create([
            'name' => 'Gusti HRD',
            'email' => 'gustiadityacreator07@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
            'google_id' => null,
            'avatar' => null,
            'department' => 'Human Resources',
        ]);

        // 3. Create Example Employee Account
        User::create([
            'name' => 'Fajar Employee',
            'email' => 'fajartergg@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'employee',
            'google_id' => null,
            'avatar' => null,
            'department' => 'Engineering',
        ]);

        // 4. Create Default Settings
        $this->seedSettings();

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📧 Owner: gustiadityamuzaky08@gmail.com');
        $this->command->info('📧 Admin: gustiadityacreator07@gmail.com');
        $this->command->info('📧 Employee: fajartergg@gmail.com');
        $this->command->info('🔑 Default password untuk testing: password');
    }

    /**
     * Seed default settings
     */
    private function seedSettings(): void
    {
        $settings = [
            [
                'key' => 'office_latitude',
                'value' => '-6.200000',
                'description' => 'Latitude koordinat kantor (default: Jakarta)',
            ],
            [
                'key' => 'office_longitude',
                'value' => '106.816666',
                'description' => 'Longitude koordinat kantor (default: Jakarta)',
            ],
            [
                'key' => 'attendance_radius',
                'value' => '50',
                'description' => 'Radius absensi dalam meter (default: 50m)',
            ],
            [
                'key' => 'work_start_time',
                'value' => '08:00',
                'description' => 'Jam mulai kerja (format: HH:MM)',
            ],
            [
                'key' => 'work_end_time',
                'value' => '17:00',
                'description' => 'Jam selesai kerja (format: HH:MM)',
            ],
            [
                'key' => 'late_tolerance_minutes',
                'value' => '15',
                'description' => 'Toleransi keterlambatan dalam menit',
            ],
            [
                'key' => 'company_name',
                'value' => 'Wengset Technology',
                'description' => 'Nama perusahaan',
            ],
            [
                'key' => 'company_address',
                'value' => 'Jakarta, Indonesia',
                'description' => 'Alamat perusahaan',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

        $this->command->info('⚙️  Default settings created');
    }
}
