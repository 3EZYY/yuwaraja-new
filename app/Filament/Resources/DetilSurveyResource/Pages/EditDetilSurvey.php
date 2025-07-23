<?php

namespace App\Filament\Resources\DetilSurveyResource\Pages;

use App\Filament\Resources\DetilSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetilSurvey extends EditRecord
{
    protected static string $resource = DetilSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make()
                ->label('Lihat'),
            Actions\DeleteAction::make()
                ->label('Hapus'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Convert opsi_jawaban to proper format if it exists
        if (isset($data['opsi_jawaban']) && is_array($data['opsi_jawaban'])) {
            $data['opsi_jawaban'] = array_values($data['opsi_jawaban']);
        }
        
        return $data;
    }

    public function getTitle(): string
    {
        return 'Edit Pertanyaan: ' . substr($this->record->pertanyaan, 0, 50) . '...';
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Pertanyaan berhasil diperbarui!';
    }
}