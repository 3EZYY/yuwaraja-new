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
        // Tabel master_survey untuk menyimpan data survey utama
        Schema::create('master_survey', function (Blueprint $table) {
            $table->id('id_master_survey');
            $table->string('judul_survey');
            $table->text('deskripsi_survey')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->datetime('tanggal_mulai');
            $table->datetime('tanggal_selesai');
            $table->unsignedBigInteger('created_by'); // ID admin yang membuat
            $table->timestamps();
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });

        // Tabel detil_survey untuk menyimpan pertanyaan-pertanyaan survey
        Schema::create('detil_survey', function (Blueprint $table) {
            $table->id('id_detil_survey');
            $table->unsignedBigInteger('id_master_survey');
            $table->text('pertanyaan');
            $table->enum('tipe_pertanyaan', ['text', 'textarea', 'radio', 'checkbox', 'select']);
            $table->json('opsi_jawaban')->nullable(); // Untuk radio, checkbox, select
            $table->boolean('wajib_diisi')->default(false);
            $table->integer('urutan')->default(1);
            $table->timestamps();
            
            $table->foreign('id_master_survey')->references('id_master_survey')->on('master_survey')->onDelete('cascade');
        });

        // Tabel hasil_survey untuk menyimpan jawaban responden
        Schema::create('hasil_survey', function (Blueprint $table) {
            $table->id('id_hasil_survey');
            $table->unsignedBigInteger('id_master_survey');
            $table->unsignedBigInteger('id_detil_survey');
            $table->unsignedBigInteger('user_id'); // ID responden
            $table->text('jawaban');
            $table->timestamps();
            
            $table->foreign('id_master_survey')->references('id_master_survey')->on('master_survey')->onDelete('cascade');
            $table->foreign('id_detil_survey')->references('id_detil_survey')->on('detil_survey')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Indeks untuk mencegah duplikasi jawaban per user per pertanyaan
            $table->unique(['id_detil_survey', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_survey');
        Schema::dropIfExists('detil_survey');
        Schema::dropIfExists('master_survey');
    }
};