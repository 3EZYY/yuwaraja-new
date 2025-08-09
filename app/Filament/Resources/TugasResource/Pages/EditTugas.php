<?php

namespace App\Filament\Resources\TugasResource\Pages;

use App\Filament\Resources\TugasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditTugas extends EditRecord
{
    protected static string $resource = TugasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Log the incoming data for debugging
        \Log::info('Tugas edit data:', $data);
        
        // Manual file validation if file_path is present
        if (!empty($data['file_path'])) {
            $filePath = $data['file_path'];
            $allowedExtensions = ['pdf', 'doc', 'docx', 'txt', 'zip', 'rar'];
            
            // If it's a string (existing file), keep it
            if (is_string($filePath)) {
                // Keep existing file path
            } else if (is_object($filePath) && method_exists($filePath, 'getClientOriginalName')) {
                // New file upload - validate extension
                $filename = $filePath->getClientOriginalName();
                $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                
                if (!in_array($extension, $allowedExtensions)) {
                    throw new \Exception('File harus berformat: PDF, DOC, DOCX, TXT, ZIP, atau RAR');
                }
            }
        } else {
            $data['file_path'] = null;
        }
        
        return $data;
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Tugas berhasil diperbarui')
            ->body('Data tugas dan file telah disimpan dengan benar.');
    }
}
