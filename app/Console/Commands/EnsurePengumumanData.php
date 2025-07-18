<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pengumuman;
use Carbon\Carbon;

class EnsurePengumumanData extends Command
{
    protected $signature = 'pengumuman:ensure-data';
    protected $description = 'Ensure pengumuman data exists in database';

    public function handle()
    {
        $this->info('Checking pengumuman data...');
        
        $count = Pengumuman::count();
        $this->info("Current pengumuman count: {$count}");
        
        if ($count < 2) {
            $this->info('Creating missing pengumuman data...');
            
            // Hapus data lama jika ada
            Pengumuman::truncate();
            
            // Buat data baru
            Pengumuman::create([
                'judul' => 'PPKMB YUWARARAJA DAY 1',
                'konten' => '<h2>Selamat Datang di PPKMB Yuwaraja!</h2><p>Intinyaaa kalian harrus stay tune yaaaa! Acara hari pertama akan sangat menarik dengan berbagai kegiatan pengenalan kampus dan orientasi mahasiswa baru.</p><ul><li>Pembukaan acara</li><li>Pengenalan kampus</li><li>Ice breaking</li><li>Sesi tanya jawab</li></ul>',
                'tipe' => 'umum',
                'is_published' => true,
                'published_at' => Carbon::parse('2025-07-13 00:29:37'),
                'created_at' => Carbon::parse('2025-07-12 17:29:42'),
                'updated_at' => Carbon::parse('2025-07-12 23:03:48'),
            ]);
            
            Pengumuman::create([
                'judul' => 'PPKMB YUWARARAJA DAY 2',
                'konten' => '<h2>Hari Kedua PPKMB Yuwaraja</h2><p>Intinyaaa kalian harrus stay tune yaaaa! Hari kedua akan lebih seru dengan kegiatan-kegiatan yang lebih interaktif dan menantang.</p><ul><li>Games dan kompetisi</li><li>Workshop skill development</li><li>Networking session</li><li>Penutupan hari kedua</li></ul><p><strong>Jangan lupa bawa semangat dan energi positif!</strong></p>',
                'tipe' => 'umum',
                'is_published' => true,
                'published_at' => Carbon::parse('2025-07-14 07:40:27'),
                'created_at' => Carbon::parse('2025-07-12 17:40:40'),
                'updated_at' => Carbon::parse('2025-07-12 23:03:55'),
            ]);
            
            $this->info('Pengumuman data created successfully!');
        } else {
            $this->info('Pengumuman data already exists.');
            
            // Pastikan semua pengumuman di-publish
            $unpublishedCount = Pengumuman::where('is_published', false)->count();
            if ($unpublishedCount > 0) {
                $this->info("Found {$unpublishedCount} unpublished pengumuman. Publishing them...");
                Pengumuman::where('is_published', false)->update([
                    'is_published' => true,
                    'published_at' => Carbon::now()
                ]);
                $this->info('All pengumuman have been published.');
            }
        }
        
        $publishedCount = Pengumuman::where('is_published', true)->count();
        $this->info("Published pengumuman count: {$publishedCount}");
        
        return 0;
    }
}