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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Lengkap
            $table->string('username')->unique();
            $table->string('email')->unique();

            // Kolom Profil dari Form - REQUIRED
            $table->string('program_studi');
            $table->string('angkatan');
            $table->string('nomor_telepon'); // Required, bukan nullable
            $table->date('tanggal_lahir'); // Required, bukan nullable
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Required, bukan nullable

            // Kolom Sistem
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'spv', 'mahasiswa'])->default('mahasiswa'); // Sesuai standar

            // Kolom Relasi (Foreign Key)
            $table->unsignedBigInteger('kelompok_id')->nullable(); // Foreign key akan ditambahkan di migrasi terpisah

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop foreign key spv_id dari kelompoks jika ada
        if (Schema::hasTable('kelompoks')) {
            try {
                \Illuminate\Support\Facades\DB::statement('ALTER TABLE kelompoks DROP FOREIGN KEY kelompoks_spv_id_foreign');
            } catch (Exception $e) {
                // abaikan error jika fk tidak ada
            }
        }
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
