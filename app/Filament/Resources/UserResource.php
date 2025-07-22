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
use Filament\Forms\Components\Textarea;

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
                    ])
                    ->required()
                    ->searchable(),

                // 1. Angkatan - Dropdown
                Forms\Components\Select::make('angkatan')
                    ->label('Angkatan')
                    ->options([
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                    ])
                    ->required()
                    ->searchable(),

                Forms\Components\TextInput::make('nomor_telepon')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->required(),

                // 2. Tempat Lahir
                Forms\Components\TextInput::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->maxLength(255),

                Forms\Components\Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),

                // 3. Jalur Masuk - Dropdown
                Forms\Components\Select::make('jalur_masuk')
                    ->label('Jalur Masuk')
                    ->options([
                        'SNBP' => 'SNBP',
                        'SNBT' => 'SNBT',
                        'Mandiri UB' => 'Mandiri UB',
                        'Mandiri Vokasi' => 'Mandiri Vokasi',
                    ])
                    ->searchable(),

                // 4. Asal Sekolah - Dropdown
                Forms\Components\Select::make('asal_sekolah_jenis')
                    ->label('Jenis Sekolah')
                    ->options([
                        'SMA' => 'SMA',
                        'SMK' => 'SMK',
                        'MAN' => 'MAN',
                        'Lainnya' => 'Lainnya',
                    ])
                    ->searchable(),

                // 5. Nama Sekolah
                Forms\Components\TextInput::make('asal_sekolah_nama')
                    ->label('Nama Sekolah')
                    ->maxLength(255),

                // 6. Jurusan/Bidang Minat
                Forms\Components\TextInput::make('jurusan_sekolah')
                    ->label('Jurusan/Bidang Minat')
                    ->maxLength(255),

                // 7. Asal Kota
                Forms\Components\TextInput::make('asal_kota')
                    ->label('Asal Kota')
                    ->maxLength(255),

                // 8. Provinsi - Dropdown dengan 38 provinsi
                Forms\Components\Select::make('provinsi')
                    ->label('Provinsi')
                    ->options([
                        'Nanggroe Aceh Darussalam' => 'Nanggroe Aceh Darussalam (Banda Aceh)',
                        'Sumatera Utara' => 'Sumatera Utara (Medan)',
                        'Sumatera Selatan' => 'Sumatera Selatan (Palembang)',
                        'Sumatera Barat' => 'Sumatera Barat (Padang)',
                        'Bengkulu' => 'Bengkulu (Bengkulu)',
                        'Riau' => 'Riau (Pekanbaru)',
                        'Kepulauan Riau' => 'Kepulauan Riau (Tanjung Pinang)',
                        'Jambi' => 'Jambi (Jambi)',
                        'Lampung' => 'Lampung (Bandar Lampung)',
                        'Bangka Belitung' => 'Bangka Belitung (Pangkal Pinang)',
                        'Kalimantan Barat' => 'Kalimantan Barat (Pontianak)',
                        'Kalimantan Timur' => 'Kalimantan Timur (Samarinda)',
                        'Kalimantan Selatan' => 'Kalimantan Selatan (Banjarbaru)',
                        'Kalimantan Tengah' => 'Kalimantan Tengah (Palangkaraya)',
                        'Kalimantan Utara' => 'Kalimantan Utara (Tanjung Selor)',
                        'Banten' => 'Banten (Serang)',
                        'DKI Jakarta' => 'DKI Jakarta (Jakarta)',
                        'Jawa Barat' => 'Jawa Barat (Bandung)',
                        'Jawa Tengah' => 'Jawa Tengah (Semarang)',
                        'Daerah Istimewa Yogyakarta' => 'Daerah Istimewa Yogyakarta (Yogyakarta)',
                        'Jawa Timur' => 'Jawa Timur (Surabaya)',
                        'Bali' => 'Bali (Denpasar)',
                        'Nusa Tenggara Timur' => 'Nusa Tenggara Timur (Kupang)',
                        'Nusa Tenggara Barat' => 'Nusa Tenggara Barat (Mataram)',
                        'Gorontalo' => 'Gorontalo (Gorontalo)',
                        'Sulawesi Barat' => 'Sulawesi Barat (Mamuju)',
                        'Sulawesi Tengah' => 'Sulawesi Tengah (Palu)',
                        'Sulawesi Utara' => 'Sulawesi Utara (Manado)',
                        'Sulawesi Tenggara' => 'Sulawesi Tenggara (Kendari)',
                        'Sulawesi Selatan' => 'Sulawesi Selatan (Makassar)',
                        'Maluku Utara' => 'Maluku Utara (Sofifi)',
                        'Maluku' => 'Maluku (Ambon)',
                        'Papua Barat' => 'Papua Barat (Manokwari)',
                        'Papua' => 'Papua (Jayapura)',
                        'Papua Tengah' => 'Papua Tengah (Nabire)',
                        'Papua Pegunungan' => 'Papua Pegunungan (Jayawijaya)',
                        'Papua Selatan' => 'Papua Selatan (Merauke)',
                        'Papua Barat Daya' => 'Papua Barat Daya (Sorong)',
                    ])
                    ->searchable(),

                // 9. Kota/Kabupaten - Dropdown
                Forms\Components\Select::make('kota_kabupaten')
                    ->label('Kota/Kabupaten')
                    ->options([
                        'Kota' => 'Kota',
                        'Kabupaten' => 'Kabupaten',
                    ])
                    ->searchable(),

                // 10. Alamat Lengkap
                Forms\Components\Textarea::make('alamat_lengkap')
                    ->label('Alamat Lengkap')
                    ->rows(3)
                    ->maxLength(500),

                // 11. Email Student.ub.ac.id
                Forms\Components\TextInput::make('email_student')
                    ->label('Email Student.ub.ac.id')
                    ->email()
                    ->suffix('@student.ub.ac.id')
                    ->maxLength(255),

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
