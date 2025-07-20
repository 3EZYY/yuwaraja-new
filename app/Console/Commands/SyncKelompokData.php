<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PengumpulanTugas;
use App\Models\User;

class SyncKelompokData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kelompok:sync-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronkan data kelompok_id di tabel pengumpulan_tugas dengan data user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai sinkronisasi data kelompok...');
        
        // Ambil semua pengumpulan tugas yang kelompok_id-nya tidak sesuai dengan user
        $pengumpulans = PengumpulanTugas::with('user')->get();
        
        $updated = 0;
        $errors = 0;
        
        foreach ($pengumpulans as $pengumpulan) {
            if ($pengumpulan->user) {
                // Jika kelompok_id di pengumpulan tidak sama dengan kelompok_id di user
                if ($pengumpulan->kelompok_id !== $pengumpulan->user->kelompok_id) {
                    try {
                        $oldKelompokId = $pengumpulan->kelompok_id;
                        $pengumpulan->kelompok_id = $pengumpulan->user->kelompok_id;
                        $pengumpulan->save();
                        
                        $this->line("Updated pengumpulan ID {$pengumpulan->id}: {$oldKelompokId} -> {$pengumpulan->user->kelompok_id}");
                        $updated++;
                    } catch (\Exception $e) {
                        $this->error("Error updating pengumpulan ID {$pengumpulan->id}: " . $e->getMessage());
                        $errors++;
                    }
                }
            } else {
                $this->warn("Pengumpulan ID {$pengumpulan->id} tidak memiliki user yang valid");
            }
        }
        
        $this->info("Sinkronisasi selesai!");
        $this->info("Total diupdate: {$updated}");
        if ($errors > 0) {
            $this->error("Total error: {$errors}");
        }
        
        return 0;
    }
}