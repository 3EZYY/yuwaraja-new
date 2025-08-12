<?php

namespace App\Filament\Resources\KelompokResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\CreateAction;
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
                    
                Forms\Components\TextInput::make('program_studi')
                    ->label('Program Studi')
                    ->maxLength(100)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('program_studi')
                    ->label('Program Studi')
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
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Anggota Baru')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['role'] = 'mahasiswa';
                        $data['kelompok_id'] = $this->getOwnerRecord()->getKey();
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),
                Tables\Actions\Action::make('remove_from_group')
                    ->label('Hapus dari Kelompok')
                    ->icon('heroicon-o-user-minus')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Hapus dari Kelompok')
                    ->modalDescription('Apakah Anda yakin ingin menghapus anggota ini dari kelompok?')
                    ->action(function ($record) {
                        $record->update(['kelompok_id' => null]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('remove_from_group_bulk')
                        ->label('Hapus dari Kelompok')
                        ->icon('heroicon-o-user-minus')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->modalHeading('Hapus dari Kelompok')
                        ->modalDescription('Apakah Anda yakin ingin menghapus anggota yang dipilih dari kelompok?')
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $record->update(['kelompok_id' => null]);
                            }
                        }),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                return $query->where('role', 'mahasiswa');
            });
    }
}
