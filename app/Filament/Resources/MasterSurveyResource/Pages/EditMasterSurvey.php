<?php

namespace App\Filament\Resources\MasterSurveyResource\Pages;

use App\Filament\Resources\MasterSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterSurvey extends EditRecord
{
    protected static string $resource = MasterSurveyResource::class;

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

    public function getTitle(): string
    {
        return 'Edit Survey: ' . $this->record->judul_survey;
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Survey berhasil diperbarui!';
    }
}