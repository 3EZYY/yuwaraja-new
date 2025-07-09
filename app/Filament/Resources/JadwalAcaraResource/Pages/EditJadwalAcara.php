<?php

namespace App\Filament\Resources\JadwalAcaraResource\Pages;

use App\Filament\Resources\JadwalAcaraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJadwalAcara extends EditRecord
{
    protected static string $resource = JadwalAcaraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
