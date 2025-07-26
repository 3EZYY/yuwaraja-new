<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AbsensiResource\Pages;
use App\Filament\Resources\AbsensiResource\RelationManagers;
use App\Models\Absensi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BadgeColumn;

class AbsensiResource extends Resource
{
    protected static ?string $model = Absensi::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    
    protected static ?string $navigationLabel = 'Manajemen Absensi';
    
    protected static ?string $modelLabel = 'Absensi';
    
    protected static ?string $pluralModelLabel = 'Absensi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Absensi')
                    ->schema([
                        Forms\Components\TextInput::make('judul')
                            ->label('Judul Absensi')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Absensi Rapat Koordinasi'),
                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->placeholder('Deskripsi detail tentang absensi ini...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])->columns(1),
                    
                Forms\Components\Section::make('Waktu & Status')
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->default(now())
                            ->native(false),
                        Forms\Components\TimePicker::make('jam_mulai')
                            ->label('Jam Mulai')
                            ->required()
                            ->seconds(false)
                            ->default('08:00'),
                        Forms\Components\TimePicker::make('jam_selesai')
                            ->label('Jam Selesai')
                            ->required()
                            ->seconds(false)
                            ->default('17:00'),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'aktif' => 'Aktif',
                                'nonaktif' => 'Non-aktif',
                            ])
                            ->default('aktif')
                            ->native(false),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul Absensi')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->time('H:i'),
                Tables\Columns\TextColumn::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->time('H:i'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'aktif',
                        'danger' => 'nonaktif',
                    ]),
                Tables\Columns\TextColumn::make('total_mahasiswa')
                    ->label('Total Request')
                    ->getStateUsing(function ($record) {
                        return $record->absensiMahasiswa()->count();
                    })
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('mahasiswa_hadir')
                    ->label('Disetujui')
                    ->getStateUsing(function ($record) {
                        return $record->absensiMahasiswa()->where('status', 'approved')->count();
                    })
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('mahasiswa_pending')
                    ->label('Pending')
                    ->getStateUsing(function ($record) {
                        return $record->absensiMahasiswa()->where('status', 'pending')->count();
                    })
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Non-aktif',
                    ]),
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail'),
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
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
            RelationManagers\AbsensiMahasiswaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAbsensis::route('/'),
            'create' => Pages\CreateAbsensi::route('/create'),
            'view' => Pages\ViewAbsensi::route('/{record}'),
            'edit' => Pages\EditAbsensi::route('/{record}/edit'),
        ];
    }
}
