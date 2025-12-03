<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Tabel settings untuk menyimpan konfigurasi sistem seperti koordinat kantor,
     * radius absen, jam kerja, dll. Menggunakan key-value pattern untuk fleksibilitas.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Nama setting (contoh: 'office_latitude')
            $table->text('value'); // Nilai setting
            $table->string('description')->nullable(); // Deskripsi untuk dokumentasi
            $table->timestamps();

            // Index untuk performa query by key
            $table->index('key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
