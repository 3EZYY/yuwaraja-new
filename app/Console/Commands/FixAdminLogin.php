<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FixAdminLogin extends Command
{
    protected $signature = 'admin:fix-login';
    protected $description = 'Fix admin login issues';

    public function handle()
    {
        $this->info('🔧 Memperbaiki masalah login admin...');

        // Cari user admin
        $admin = User::where('username', 'admin')->first();
        
        if (!$admin) {
            $this->error('❌ Admin user tidak ditemukan!');
            return;
        }

        $this->info('✅ Admin user ditemukan:');
        $this->line('   - ID: ' . $admin->id);
        $this->line('   - Username: ' . $admin->username);
        $this->line('   - Email: ' . $admin->email);
        $this->line('   - Role: ' . $admin->role);

        // Reset password admin
        $newPassword = 'admin123';
        $admin->password = Hash::make($newPassword);
        $admin->save();

        $this->info('✅ Password admin berhasil direset!');
        $this->line('   - Username: admin');
        $this->line('   - Email: admin@yuwaraja.com');
        $this->line('   - Password: ' . $newPassword);

        // Test credential
        $this->info('🧪 Testing credentials...');
        
        // Test dengan username
        if (Hash::check($newPassword, $admin->password)) {
            $this->info('✅ Password hash berhasil diverifikasi');
        } else {
            $this->error('❌ Password hash gagal diverifikasi');
        }

        $this->info('🎉 Perbaikan selesai! Silakan coba login dengan:');
        $this->line('   Username: admin');
        $this->line('   Password: admin123');
        $this->line('   Atau gunakan email: admin@yuwaraja.com');
    }
}
