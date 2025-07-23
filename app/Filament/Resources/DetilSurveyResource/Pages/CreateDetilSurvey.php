<?php

namespace App\Filament\Resources\DetilSurveyResource\Pages;

use App\Filament\Resources\DetilSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDetilSurvey extends CreateRecord
{
    protected static string $resource = DetilSurveyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Convert opsi_jawaban to proper format if it exists
        if (isset($data['opsi_jawaban']) && is_array($data['opsi_jawaban'])) {
            $data['opsi_jawaban'] = array_values($data['opsi_jawaban']);
        }
        
        return $data;
    }

    public function getTitle(): string
    {
        return 'Tambah Pertanyaan Survey';
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Pertanyaan berhasil ditambahkan!';
    }
}