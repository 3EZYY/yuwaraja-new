<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Filament\Resources\AbsensiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Get;

class CreateAbsensi extends CreateRecord
{
    protected static string $resource = AbsensiResource::class;
    
    protected function getFormSchema(): array
    {
        return [
            ...parent::getFormSchema(),
            
            // Tambahkan preview countdown
            ViewField::make('countdown_preview')
                ->label('Preview Waktu')
                ->view('filament.forms.components.countdown-preview')
                ->columnSpanFull()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set, Get $get) {
                    // Update preview saat form berubah
                })
        ];
    }
}
