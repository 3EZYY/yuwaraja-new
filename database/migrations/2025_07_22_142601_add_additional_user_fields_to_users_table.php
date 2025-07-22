<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kolom yang belum ada - hanya menambahkan yang diperlukan
            $table->text('alamat_lengkap')->nullable()->after('alamat_domisili');
            $table->enum('kota_kabupaten', ['Kota', 'Kabupaten'])->nullable()->after('kota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'alamat_lengkap',
                'kota_kabupaten'
            ]);
        });
    }
};
