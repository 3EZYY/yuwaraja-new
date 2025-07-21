<?php

namespace App\Filament\Resources\KelompokResource\Pages;

use App\Filament\Resources\KelompokResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateKelompok extends CreateRecord
{
    protected static string $resource = KelompokResource::class;

    public function getTitle(): string
    {
        return 'Buat Cluster';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '/admin/dashboard/cluster' => 'Cluster',
            '' => 'Buat',
        ];
    }

    protected function afterCreate(): void
    {
        // Clear OPcache untuk memastikan data fresh
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }

        // Kirim notifikasi sukses
        Notification::make()
            ->title('Cluster berhasil dibuat!')
            ->success()
            ->send();
    }
}
