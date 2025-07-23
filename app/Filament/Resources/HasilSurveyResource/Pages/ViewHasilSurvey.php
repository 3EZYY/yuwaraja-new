<?php

namespace App\Filament\Resources\HasilSurveyResource\Pages;

use App\Filament\Resources\HasilSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\BadgeEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;

class ViewHasilSurvey extends ViewRecord
{
    protected static string $resource = HasilSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Hapus'),
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
                                TextEntry::make('masterSurvey.judul_survey')
                                    ->label('Judul Survey'),
                                BadgeEntry::make('masterSurvey.status')
                                    ->label('Status Survey')
                                    ->color(fn (string $state): string => match ($state) {
                                        'aktif' => 'success',
                                        'nonaktif' => 'danger',
                                    })
                                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                            ]),
                        TextEntry::make('masterSurvey.deskripsi_survey')
                            ->label('Deskripsi Survey')
                            ->columnSpanFull(),
                    ]),
                
                Section::make('Informasi Pertanyaan')
                    ->schema([
                        TextEntry::make('detilSurvey.pertanyaan')
                            ->label('Pertanyaan')
                            ->columnSpanFull(),
                        Grid::make(3)
                            ->schema([
                                BadgeEntry::make('detilSurvey.tipe_pertanyaan')
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
                                BadgeEntry::make('detilSurvey.wajib_diisi')
                                    ->label('Wajib Diisi')
                                    ->color(fn (bool $state): string => $state ? 'success' : 'gray')
                                    ->formatStateUsing(fn (bool $state): string => $state ? 'Ya' : 'Tidak'),
                                TextEntry::make('detilSurvey.urutan')
                                    ->label('Urutan Pertanyaan')
                                    ->badge(),
                            ]),
                    ]),
                
                Section::make('Informasi Responden')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Nama Responden'),
                                TextEntry::make('user.nim')
                                    ->label('NIM'),
                                TextEntry::make('user.program_studi')
                                    ->label('Program Studi'),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('user.angkatan')
                                    ->label('Angkatan'),
                                TextEntry::make('user.role')
                                    ->label('Role')
                                    ->badge()
                                    ->color(fn (string $state): string => match($state) {
                                        'admin' => 'danger',
                                        'spv' => 'warning',
                                        'mahasiswa' => 'success',
                                        default => 'gray'
                                    }),
                            ]),
                    ]),
                
                Section::make('Jawaban')
                    ->schema([
                        TextEntry::make('jawaban')
                            ->label('Jawaban Responden')
                            ->columnSpanFull()
                            ->formatStateUsing(function ($state, $record) {
                                // Format jawaban berdasarkan tipe pertanyaan
                                $tipe = $record->detilSurvey->tipe_pertanyaan;
                                
                                if ($tipe === 'checkbox') {
                                    // Untuk checkbox, decode JSON dan tampilkan sebagai list
                                    $jawaban = is_string($state) ? json_decode($state, true) : $state;
                                    if (is_array($jawaban)) {
                                        return implode(', ', $jawaban);
                                    }
                                }
                                
                                if (in_array($tipe, ['radio', 'select'])) {
                                    // Untuk radio dan select, cari label dari opsi
                                    $opsiJawaban = $record->detilSurvey->opsi_jawaban ?? [];
                                    foreach ($opsiJawaban as $opsi) {
                                        if (is_array($opsi) && ($opsi['value'] ?? '') === $state) {
                                            return $opsi['label'] ?? $state;
                                        }
                                    }
                                }
                                
                                return $state;
                            }),
                        TextEntry::make('created_at')
                            ->label('Dijawab Pada')
                            ->dateTime('d/m/Y H:i:s'),
                    ]),
            ]);
    }

    public function getTitle(): string
    {
        return 'Detail Jawaban Survey';
    }
}