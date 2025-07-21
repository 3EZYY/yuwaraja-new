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
            // Email Student (khusus untuk email student)
            $table->string('email_student')->nullable()->after('email');
            
            // Asal Sekolah
            $table->enum('asal_sekolah_jenis', ['SMA', 'SMK', 'MAN', 'Lainnya'])->nullable()->after('jenis_kelamin');
            $table->string('asal_sekolah_nama')->nullable()->after('asal_sekolah_jenis');
            
            // Jurusan/Bidang Minat di sekolah asal
            $table->string('jurusan_sekolah')->nullable()->after('asal_sekolah_nama');
            
            // Lokasi
            $table->string('asal_kota')->nullable()->after('jurusan_sekolah');
            $table->text('alamat_domisili')->nullable()->after('asal_kota');
            $table->string('provinsi')->nullable()->after('alamat_domisili');
            $table->string('kota')->nullable()->after('provinsi');
            
            // Jalur Masuk
            $table->enum('jalur_masuk', ['SNBP', 'SNBT', 'Mandiri UB', 'Mandiri Vokasi'])->nullable()->after('kota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_student',
                'asal_sekolah_jenis',
                'asal_sekolah_nama',
                'jurusan_sekolah',
                'asal_kota',
                'alamat_domisili',
                'provinsi',
                'kota',
                'jalur_masuk'
            ]);
        });
    }
};