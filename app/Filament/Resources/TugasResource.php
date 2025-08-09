<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TugasResource\Pages;
use App\Filament\Resources\TugasResource\RelationManagers;
use App\Models\Tugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;

class TugasResource extends Resource
{
    protected static ?string $model = Tugas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Penugasan';

    protected static ?string $navigationGroup = 'Manajemen Penugasan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('deadline')
                    ->required()
                    ->seconds(false)
                    ->displayFormat('d/m/Y H:i')
                    ->helperText('Pilih tanggal dan jam deadline tugas'),
                Forms\Components\Select::make('tipe')
                    ->options([
                        'individual' => 'Individual',
                        'kelompok' => 'Kelompok',
                    ])
                    ->required()
                    ->default('kelompok'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('File Tugas')
                    ->disk('public')
                    ->directory('tugas-files')
                    ->maxSize(10240) // 10MB
                    ->downloadable()
                    ->openable()
                    ->columnSpanFull()
                    ->helperText('Upload file tugas yang dapat diunduh oleh mahasiswa. Format yang didukung: PDF, DOC, DOCX, TXT, ZIP, RAR. Maksimal 10MB.')
                    ->nullable()
                    ->preserveFilenames(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipe'),
                Tables\Columns\TextColumn::make('file_path')
                    ->label('File')
                    ->formatStateUsing(fn ($state) => $state ? 'Ada File' : 'Tidak Ada File')
                    ->badge()
                    ->color(fn ($state) => $state ? 'success' : 'gray'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download File')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => $record->file_path ? asset('storage/' . $record->file_path) : null)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->file_path !== null),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListTugas::route('/'),
            'create' => Pages\CreateTugas::route('/create'),
            'edit' => Pages\EditTugas::route('/{record}/edit'),
        ];
    }
}
