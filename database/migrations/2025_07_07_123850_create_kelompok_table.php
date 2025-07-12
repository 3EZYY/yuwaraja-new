<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kelompoks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok')->unique();
            // Relasi ke user yang menjadi SPV
            $table->foreignId('spv_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('kelompoks')) {
            try {
                DB::statement('ALTER TABLE kelompoks DROP FOREIGN KEY kelompoks_spv_id_foreign');
            } catch (Exception $e) {
                // Foreign key might not exist, ignore error
            }
            Schema::dropIfExists('kelompoks');
        }
    }
};
