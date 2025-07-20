<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminProfileResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class AdminProfileResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    
    protected static ?string $navigationLabel = 'Profile Admin';
    
    protected static ?string $modelLabel = 'Profile Admin';
    
    protected static ?string $pluralModelLabel = 'Profile Admin';

    protected static ?string $navigationGroup = 'Pengaturan';
    
    // Sembunyikan dari navigation
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Profile')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('nim')
                            ->label('NIM')
                            ->maxLength(20),
                            
                        TextInput::make('jurusan')
                            ->label('Jurusan/Prodi')
                            ->maxLength(100),
                            
                        FileUpload::make('photo')
                            ->label('Foto Profile')
                            ->image()
                            ->directory('profile-pictures')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                            ])
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->helperText('Upload foto profile Anda (maksimal 2MB, format: JPG, PNG)')
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->defaultImageUrl(url('/images/default-avatar.svg')),
                    
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),
                    
                TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->searchable(),
                    
                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'success',
                        'spv' => 'warning',
                        'mahasiswa' => 'primary',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'spv' => 'Supervisor',
                        'mahasiswa' => 'Mahasiswa',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit Profile'),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                // Hanya tampilkan user yang sedang login (admin)
                return $query->where('id', Auth::id());
            });
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
            'index' => Pages\ListAdminProfiles::route('/'),
            'edit' => Pages\EditAdminProfile::route('/{record}/edit'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return false; // Admin tidak bisa membuat profile baru
    }
    
    public static function canDelete($record): bool
    {
        return false; // Admin tidak bisa menghapus profile
    }
    
    public static function canDeleteAny(): bool
    {
        return false;
    }
}
