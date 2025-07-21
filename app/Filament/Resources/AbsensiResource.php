<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsensiResource\Pages;
use App\Models\Absensi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\AbsensiResource\Actions\DownloadQrCodeAction;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static ?string $navigationLabel = 'Management Absensi';

    protected static ?string $modelLabel = 'Absensi';

    protected static ?string $pluralModelLabel = 'Management Absensi';

    protected static ?string $navigationGroup = 'Absensi';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Absensi')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul Absensi')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Absensi Day 1'),

                        Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->placeholder('Deskripsi tambahan untuk absensi ini'),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Waktu Absensi')
                    ->schema([
                        DateTimePicker::make('jam_mulai')
                            ->label('Jam Mulai')
                            ->required()
                            ->seconds(false)
                            ->displayFormat('d/m/Y H:i')
                            ->default(now()),

                        DateTimePicker::make('jam_selesai')
                            ->label('Jam Selesai')
                            ->required()
                            ->seconds(false)
                            ->displayFormat('d/m/Y H:i')
                            ->default(now()->addHours(6))
                            ->after('jam_mulai'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Absensi hanya bisa digunakan jika dalam status aktif'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                BadgeColumn::make('status_text')
                    ->label('Status')
                    ->colors([
                        'gray' => 'Tidak Aktif',
                        'yellow' => 'Belum Dimulai',
                        'green' => 'Sedang Berlangsung',
                        'red' => 'Sudah Berakhir',
                    ]),

                TextColumn::make('total_hadir')
                    ->label('Total Hadir')
                    ->badge()
                    ->color('success'),

                BooleanColumn::make('is_active')
                    ->label('Aktif'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                DownloadQrCodeAction::make(),
                Action::make('view_participants')
                    ->label('Lihat Peserta')
                    ->icon('heroicon-o-users')
                    ->color('info')
                    ->url(fn (Absensi $record): string => route('filament.admin.resources.absensi.participants', $record)),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensi::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
            'participants' => Pages\ViewAbsensiParticipants::route('/{record}/participants'),
        ];
    }
}