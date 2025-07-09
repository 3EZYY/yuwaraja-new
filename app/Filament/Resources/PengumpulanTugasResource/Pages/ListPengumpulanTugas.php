<?php

namespace App\Filament\Resources\PengumpulanTugasResource\Pages;

use App\Filament\Resources\PengumpulanTugasResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengumpulanTugas extends ListRecords
{
    protected static string $resource = PengumpulanTugasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
