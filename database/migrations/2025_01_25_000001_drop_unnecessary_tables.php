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
        // Drop cache related tables
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        
        // Drop job related tables
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
        
        // Drop cities and provinces tables
        Schema::dropIfExists('cities');
        Schema::dropIfExists('provinces');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: This migration is for cleanup only
        // If you need to restore these tables, you'll need to recreate them manually
        // or restore from backup
    }
};