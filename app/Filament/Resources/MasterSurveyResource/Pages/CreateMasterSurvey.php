<?php

namespace App\Filament\Resources\MasterSurveyResource\Pages;

use App\Filament\Resources\MasterSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateMasterSurvey extends CreateRecord
{
    protected static string $resource = MasterSurveyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = Auth::id();
        
        return $data;
    }

    public function getTitle(): string
    {
        return 'Buat Survey Baru';
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Survey berhasil dibuat!';
    }
}