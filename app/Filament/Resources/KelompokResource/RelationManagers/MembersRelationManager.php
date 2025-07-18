<?php

namespace App\Filament\Resources\KelompokResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';
    
    protected static ?string $title = 'Anggota Kelompok';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->maxLength(20),
                    
                Forms\Components\TextInput::make('jurusan')
                    ->label('Jurusan')
                    ->maxLength(100),
                    
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Profile')
                    ->image()
                    ->directory('profile-pictures')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                    ])
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->helperText('Upload foto profile (maksimal 2MB, format: JPG, PNG)')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto Profile')
                    ->circular()
                    ->size(60)
                    ->defaultImageUrl(url('/images/default-avatar.svg')),
                    
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\BadgeColumn::make('role')
                    ->label('Role')
                    ->colors([
                        'success' => 'admin',
                        'warning' => 'spv',
                        'primary' => 'mahasiswa',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'spv' => 'Supervisor',
                        'mahasiswa' => 'Mahasiswa',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Tambah Anggota')
                    ->preloadRecordSelect()
                    ->recordSelectSearchColumns(['name', 'nim', 'email'])
                    ->form(fn (Tables\Actions\AttachAction $action): array => [
                        $action->getRecordSelect(),
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\DetachAction::make()
                    ->label('Hapus dari Kelompok'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->label('Hapus dari Kelompok'),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('role', 'mahasiswa');
            });
    }
}
