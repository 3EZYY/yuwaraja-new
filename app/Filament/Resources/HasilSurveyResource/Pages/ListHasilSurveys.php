<?php

namespace App\Filament\Resources\HasilSurveyResource\Pages;

use App\Filament\Resources\HasilSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Concerns\ExposesTableToWidgets;

class ListHasilSurveys extends ListRecords
{
    use ExposesTableToWidgets;
    
    protected static string $resource = HasilSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Statistik akan ditambahkan nanti
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Add survey statistics widgets here if needed
        ];
    }

    public function getTitle(): string
    {
        return 'Hasil Survey';
    }
}