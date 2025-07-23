<?php

namespace App\Filament\Resources\MasterSurveyResource\Pages;

use App\Filament\Resources\MasterSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\BadgeEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;

class ViewMasterSurvey extends ViewRecord
{
    protected static string $resource = MasterSurveyResource::class;

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
                Section::make('Informasi Survey')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('judul_survey')
                                    ->label('Judul Survey'),
                                BadgeEntry::make('status')
                                    ->label('Status')
                                    ->color(fn (string $state): string => match ($state) {
                                        'aktif' => 'success',
                                        'nonaktif' => 'danger',
                                    })
                                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                            ]),
                        TextEntry::make('deskripsi_survey')
                            ->label('Deskripsi Survey')
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('tanggal_mulai')
                                    ->label('Tanggal Mulai')
                                    ->dateTime('d/m/Y H:i'),
                                TextEntry::make('tanggal_selesai')
                                    ->label('Tanggal Selesai')
                                    ->dateTime('d/m/Y H:i'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('creator.name')
                                    ->label('Dibuat Oleh'),
                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d/m/Y H:i'),
                            ]),
                    ]),
                
                Section::make('Statistik Survey')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('detilSurvey_count')
                                    ->label('Jumlah Pertanyaan')
                                    ->state(fn ($record) => $record->detilSurvey->count())
                                    ->badge()
                                    ->color('info'),
                                TextEntry::make('total_responden')
                                    ->label('Total Responden')
                                    ->state(fn ($record) => $record->hasilSurvey->pluck('user_id')->unique()->count())
                                    ->badge()
                                    ->color('success'),
                                TextEntry::make('total_jawaban')
                                    ->label('Total Jawaban')
                                    ->state(fn ($record) => $record->hasilSurvey->count())
                                    ->badge()
                                    ->color('warning'),
                            ]),
                    ]),
            ]);
    }

    public function getTitle(): string
    {
        return 'Detail Survey: ' . $this->record->judul_survey;
    }
}