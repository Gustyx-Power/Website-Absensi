<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdateCoordinatesSeeder extends Seeder
{
    /**
     * Seed database dengan koordinat baru.
     */
    public function run(): void
    {
        DB::table('settings')
            ->where('key', 'office_latitude')
            ->update(['value' => '-6.2160896']);

        DB::table('settings')
            ->where('key', 'office_longitude')
            ->update(['value' => '106.8859392']);

        $this->command->info('✅ Office coordinates updated successfully!');
        $this->command->info('Latitude: ' . DB::table('settings')->where('key', 'office_latitude')->value('value'));
        $this->command->info('Longitude: ' . DB::table('settings')->where('key', 'office_longitude')->value('value'));
    }
}
