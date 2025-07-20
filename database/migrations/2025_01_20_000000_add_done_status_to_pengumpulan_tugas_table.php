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
        // Update enum untuk menambahkan status 'done'
        DB::statement("ALTER TABLE pengumpulan_tugas MODIFY COLUMN status ENUM('draft', 'submitted', 'reviewed', 'approved', 'rejected', 'done') DEFAULT 'draft'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan enum ke status sebelumnya
        DB::statement("ALTER TABLE pengumpulan_tugas MODIFY COLUMN status ENUM('draft', 'submitted', 'reviewed', 'approved', 'rejected') DEFAULT 'draft'");
    }
};