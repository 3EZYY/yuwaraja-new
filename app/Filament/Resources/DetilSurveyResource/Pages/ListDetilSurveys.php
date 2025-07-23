<?php

namespace App\Filament\Resources\DetilSurveyResource\Pages;

use App\Filament\Resources\DetilSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetilSurveys extends ListRecords
{
    protected static string $resource = DetilSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Pertanyaan'),
        ];
    }

    public function getTitle(): string
    {
        return 'Daftar Pertanyaan Survey';
    }
}