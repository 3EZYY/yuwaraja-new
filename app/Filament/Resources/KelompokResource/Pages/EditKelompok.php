<?php

namespace App\Filament\Resources\KelompokResource\Pages;

use App\Filament\Resources\KelompokResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditKelompok extends EditRecord
{
    protected static string $resource = KelompokResource::class;

    public function getTitle(): string
    {
        return 'Edit Cluster';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '/admin/dashboard/cluster' => 'Cluster',
            '' => 'Edit',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Clear any potential cache
        if (function_exists('opcache_reset')) {
            opcache_reset();
        }
        
        // Send notification
        Notification::make()
            ->title('Cluster berhasil diperbarui')
            ->body('Data cluster telah diperbarui dan akan terlihat di semua halaman.')
            ->success()
            ->send();
    }
}
