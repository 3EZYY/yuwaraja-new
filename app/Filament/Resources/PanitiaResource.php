<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PanitiaResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PanitiaResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Panitia';

    protected static ?string $modelLabel = 'Panitia';

    protected static ?string $pluralModelLabel = 'Panitia';

    protected static ?string $navigationGroup = 'User Management';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereIn('role', ['admin', 'spv_admin', 'spv']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'spv_admin' => 'Supervisor Admin',
                        'spv' => 'Supervisor',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state): bool => filled($state))
                    ->dehydrateStateUsing(fn ($state): string => bcrypt($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'spv_admin' => 'warning',
                        'spv' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(function ($state) {
                        return match($state) {
                            'admin' => 'Admin',
                            'spv_admin' => 'Supervisor Admin',
                            'spv' => 'Supervisor',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'spv_admin' => 'Supervisor Admin',
                        'spv' => 'Supervisor',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPanitia::route('/'),
            'create' => Pages\CreatePanitia::route('/create'),
            'edit' => Pages\EditPanitia::route('/{record}/edit'),
        ];
    }
}
