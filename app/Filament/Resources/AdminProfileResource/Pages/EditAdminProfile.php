<?php

namespace App\Filament\Resources\AdminProfileResource\Pages;

use App\Filament\Resources\AdminProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditAdminProfile extends EditRecord
{
    protected static string $resource = AdminProfileResource::class;
    
    protected static ?string $title = 'Edit Profile Admin';

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada action delete untuk profile admin
        ];
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Profile berhasil diupdate!')
            ->body('Data profile Anda telah berhasil disimpan.');
    }
}
