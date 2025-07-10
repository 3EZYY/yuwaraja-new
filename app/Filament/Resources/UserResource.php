<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    protected static ?string $navigationLabel = 'Manajemen User';
    
    protected static ?string $modelLabel = 'User';
    
    protected static ?string $pluralModelLabel = 'Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\TextInput::make('username')
                    ->label('Username')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                // Menggunakan Select untuk Program Studi
                Forms\Components\Select::make('program_studi')
                    ->label('Program Studi')
                    ->options([
                        'D4 Manajemen Perhotelan' => 'D4 Manajemen Perhotelan',
                        'D3 Keuangan dan Perbankan' => 'D3 Keuangan dan Perbankan',
                        'D3 Administrasi Bisnis' => 'D3 Administrasi Bisnis',
                        'D4 Desain Grafis' => 'D4 Desain Grafis',
                        'D3 Teknologi Informasi' => 'D3 Teknologi Informasi',
                        'Sistem Informasi' => 'Sistem Informasi',
                        'Teknik Informatika' => 'Teknik Informatika',
                    ])
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('angkatan')
                    ->label('Angkatan')
                    ->required()
                    ->maxLength(4)
                    ->placeholder('2024'),

                Forms\Components\TextInput::make('nomor_telepon')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->required(),

                Forms\Components\Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),

                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'spv' => 'SPV',
                        'mahasiswa' => 'Mahasiswa',
                    ])
                    ->required(),

                // Select untuk menugaskan ke Cluster
                Forms\Components\Select::make('kelompok_id')
                    ->label('Cluster/Kelompok')
                    ->relationship('kelompok', 'nama_kelompok')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih Kelompok'),

                Forms\Components\TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('program_studi')
                    ->label('Program Studi')
                    ->sortable(),

                Tables\Columns\TextColumn::make('angkatan')
                    ->label('Angkatan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'spv' => 'warning',
                        'mahasiswa' => 'success',
                    }),

                Tables\Columns\TextColumn::make('kelompok.nama_kelompok')
                    ->label('Cluster')
                    ->sortable()
                    ->placeholder('Belum ada kelompok'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->label('Filter Role')
                    ->options([
                        'admin' => 'Admin',
                        'spv' => 'SPV',
                        'mahasiswa' => 'Mahasiswa',
                    ]),

                Tables\Filters\SelectFilter::make('program_studi')
                    ->label('Filter Program Studi')
                    ->options([
                        'D4 Manajemen Perhotelan' => 'D4 Manajemen Perhotelan',
                        'D3 Keuangan dan Perbankan' => 'D3 Keuangan dan Perbankan',
                        'D3 Administrasi Bisnis' => 'D3 Administrasi Bisnis',
                        'D4 Desain Grafis' => 'D4 Desain Grafis',
                        'D3 Teknologi Informasi' => 'D3 Teknologi Informasi',
                        'Sistem Informasi' => 'Sistem Informasi',
                        'Teknik Informatika' => 'Teknik Informatika',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
