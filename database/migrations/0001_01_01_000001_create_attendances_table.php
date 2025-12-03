<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Tabel attendances untuk menyimpan record check-in dan check-out karyawan.
     * Setiap record menyimpan foto selfie, koordinat GPS, dan jarak dari kantor.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Type: check_in atau check_out
            $table->enum('type', ['check_in', 'check_out']);

            // Foto selfie yang diambil saat absen
            $table->string('photo');

            // Koordinat GPS user saat absen
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            // Jarak dari kantor (dalam meter), dihitung menggunakan Haversine Formula
            $table->decimal('distance', 8, 2);

            // Status: on_time (tepat waktu), late (terlambat), early_leave (pulang cepat)
            $table->enum('status', ['on_time', 'late', 'early_leave'])->default('on_time');

            // Catatan tambahan (opsional)
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes untuk performa query
            $table->index('user_id');
            $table->index('type');
            $table->index('created_at');
            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
