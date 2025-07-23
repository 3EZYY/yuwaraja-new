<?php

namespace App\Filament\Resources\DetilSurveyResource\Pages;

use App\Filament\Resources\DetilSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\BadgeEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\RepeatableEntry;

class ViewDetilSurvey extends ViewRecord
{
    protected static string $resource = DetilSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                ->label('Edit'),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Pertanyaan')
                    ->schema([
                        TextEntry::make('masterSurvey.judul_survey')
                            ->label('Survey'),
                        TextEntry::make('pertanyaan')
                            ->label('Pertanyaan')
                            ->columnSpanFull(),
                        Grid::make(3)
                            ->schema([
                                BadgeEntry::make('tipe_pertanyaan')
                                    ->label('Tipe Pertanyaan')
                                    ->color(fn (string $state): string => match($state) {
                                        'text' => 'primary',
                                        'textarea' => 'success',
                                        'radio' => 'warning',
                                        'checkbox' => 'danger',
                                        'select' => 'info',
                                        default => 'gray'
                                    })
                                    ->formatStateUsing(fn (string $state): string => match($state) {
                                        'text' => 'Text Input',
                                        'textarea' => 'Text Area',
                                        'radio' => 'Radio Button',
                                        'checkbox' => 'Checkbox',
                                        'select' => 'Select Dropdown',
                                        default => ucfirst($state)
                                    }),
                                BadgeEntry::make('wajib_diisi')
                                    ->label('Wajib Diisi')
                                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                                    ->formatStateUsing(fn (bool $state): string => $state ? 'Ya' : 'Tidak'),
                                TextEntry::make('urutan')
                                    ->label('Urutan')
                                    ->badge(),
                            ]),
                    ]),
                
                Section::make('Opsi Jawaban')
                    ->schema([
                        RepeatableEntry::make('opsi_jawaban')
                            ->label('')
                            ->schema([
                                TextEntry::make('value')
                                    ->label('Nilai'),
                                TextEntry::make('label')
                                    ->label('Label'),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ])
                    ->visible(fn ($record) => in_array($record->tipe_pertanyaan, ['radio', 'checkbox', 'select']) && !empty($record->opsi_jawaban)),
                
                Section::make('Informasi Tambahan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d/m/Y H:i'),
                                TextEntry::make('updated_at')
                                    ->label('Diperbarui Pada')
                                    ->dateTime('d/m/Y H:i'),
                            ]),
                    ]),
            ]);
    }

    public function getTitle(): string
    {
        return 'Detail Pertanyaan: ' . substr($this->record->pertanyaan, 0, 50) . '...';
    }
}