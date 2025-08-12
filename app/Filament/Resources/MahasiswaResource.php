<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;

class MahasiswaResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Mahasiswa';

    protected static ?string $modelLabel = 'Mahasiswa';

    protected static ?string $pluralModelLabel = 'Mahasiswa';

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $slug = 'mahasiswa';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'mahasiswa');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Profil')
                    ->image()
                    ->disk('public')
                    ->directory('profile-photos')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                    ])
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('nim')
                    ->label('NIM')
                    ->required()
                    ->maxLength(20),
                
                Forms\Components\TextInput::make('username')
                    ->label('Username')
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Select::make('program_studi')
                    ->label('Program Studi')
                    ->options([
                        'D3 Teknologi Informasi' => 'D3 Teknologi Informasi',
                        'D3 Teknik Komputer' => 'D3 Teknik Komputer',
                        'D3 Teknik Elektro' => 'D3 Teknik Elektro',
                        'D3 Teknik Mesin' => 'D3 Teknik Mesin',
                        'D3 Teknik Sipil' => 'D3 Teknik Sipil',
                        'D3 Akuntansi' => 'D3 Akuntansi',
                        'D3 Administrasi Bisnis' => 'D3 Administrasi Bisnis',
                        'D3 Keuangan dan Perbankan' => 'D3 Keuangan dan Perbankan',
                        'D3 Bahasa Inggris' => 'D3 Bahasa Inggris',
                        'D4 Teknologi Rekayasa Komputer' => 'D4 Teknologi Rekayasa Komputer',
                        'D4 Teknologi Rekayasa Elektro' => 'D4 Teknologi Rekayasa Elektro',
                        'D4 Teknologi Rekayasa Mesin' => 'D4 Teknologi Rekayasa Mesin',
                        'D4 Teknologi Rekayasa Sipil' => 'D4 Teknologi Rekayasa Sipil',
                        'D4 Akuntansi Manajemen' => 'D4 Akuntansi Manajemen',
                        'D4 Administrasi Bisnis Terapan' => 'D4 Administrasi Bisnis Terapan',
                        'D4 Bahasa Inggris Terapan' => 'D4 Bahasa Inggris Terapan',
                    ])
                    ->searchable()
                    ->required(),
                
                Forms\Components\Select::make('angkatan')
                    ->label('Angkatan')
                    ->options([
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                    ])
                    ->required(),
                
                Forms\Components\TextInput::make('nomor_telepon')
                    ->label('Nomor Telepon')
                    ->tel()
                    ->maxLength(20),
                
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->label('Tanggal Lahir'),
                
                Forms\Components\TextInput::make('tempat_lahir')
                    ->label('Tempat Lahir')
                    ->maxLength(255),
                
                Forms\Components\Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
                
                Forms\Components\Select::make('jalur_masuk')
                    ->label('Jalur Masuk')
                    ->options([
                        'SNBP' => 'SNBP',
                        'SNBT' => 'SNBT',
                        'Mandiri UB' => 'Mandiri UB',
                        'Mandiri Vokasi' => 'Mandiri Vokasi',
                    ]),
                
                Forms\Components\Select::make('asal_sekolah_jenis')
                    ->label('Jenis Sekolah')
                    ->options([
                        'SMA' => 'SMA',
                        'SMK' => 'SMK',
                        'MAN' => 'MAN',
                        'Lainnya' => 'Lainnya',
                    ]),
                
                Forms\Components\TextInput::make('asal_sekolah_nama')
                    ->label('Nama Sekolah')
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('jurusan_sekolah')
                    ->label('Jurusan/Bidang Minat')
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('asal_kota')
                    ->label('Asal Kota')
                    ->maxLength(255),
                
                Forms\Components\Select::make('provinsi')
                    ->label('Provinsi')
                    ->options([
                        'Nanggroe Aceh Darussalam (Banda Aceh)' => 'Nanggroe Aceh Darussalam (Banda Aceh)',
                        'Sumatera Utara (Medan)' => 'Sumatera Utara (Medan)',
                        'Sumatera Selatan (Palembang)' => 'Sumatera Selatan (Palembang)',
                        'Sumatera Barat (Padang)' => 'Sumatera Barat (Padang)',
                        'Bengkulu (Bengkulu)' => 'Bengkulu (Bengkulu)',
                        'Riau (Pekanbaru)' => 'Riau (Pekanbaru)',
                        'Kepulauan Riau (Tanjung Pinang)' => 'Kepulauan Riau (Tanjung Pinang)',
                        'Jambi (Jambi)' => 'Jambi (Jambi)',
                        'Lampung (Bandar Lampung)' => 'Lampung (Bandar Lampung)',
                        'Bangka Belitung (Pangkal Pinang)' => 'Bangka Belitung (Pangkal Pinang)',
                        'Kalimantan Barat (Pontianak)' => 'Kalimantan Barat (Pontianak)',
                        'Kalimantan Timur (Samarinda)' => 'Kalimantan Timur (Samarinda)',
                        'Kalimantan Selatan (Banjarbaru)' => 'Kalimantan Selatan (Banjarbaru)',
                        'Kalimantan Tengah (Palangkaraya)' => 'Kalimantan Tengah (Palangkaraya)',
                        'Kalimantan Utara (Tanjung Selor)' => 'Kalimantan Utara (Tanjung Selor)',
                        'Banten (Serang)' => 'Banten (Serang)',
                        'DKI Jakarta (Jakarta)' => 'DKI Jakarta (Jakarta)',
                        'Jawa Barat (Bandung)' => 'Jawa Barat (Bandung)',
                        'Jawa Tengah (Semarang)' => 'Jawa Tengah (Semarang)',
                        'Daerah Istimewa Yogyakarta (Yogyakarta)' => 'Daerah Istimewa Yogyakarta (Yogyakarta)',
                        'Jawa Timur (Surabaya)' => 'Jawa Timur (Surabaya)',
                        'Bali (Denpasar)' => 'Bali (Denpasar)',
                        'Nusa Tenggara Timur (Kupang)' => 'Nusa Tenggara Timur (Kupang)',
                        'Nusa Tenggara Barat (Mataram)' => 'Nusa Tenggara Barat (Mataram)',
                        'Gorontalo (Gorontalo)' => 'Gorontalo (Gorontalo)',
                        'Sulawesi Barat (Mamuju)' => 'Sulawesi Barat (Mamuju)',
                        'Sulawesi Tengah (Palu)' => 'Sulawesi Tengah (Palu)',
                        'Sulawesi Utara (Manado)' => 'Sulawesi Utara (Manado)',
                        'Sulawesi Tenggara (Kendari)' => 'Sulawesi Tenggara (Kendari)',
                        'Sulawesi Selatan (Makassar)' => 'Sulawesi Selatan (Makassar)',
                        'Maluku Utara (Sofifi)' => 'Maluku Utara (Sofifi)',
                        'Maluku (Ambon)' => 'Maluku (Ambon)',
                        'Papua Barat (Manokwari)' => 'Papua Barat (Manokwari)',
                        'Papua (Jayapura)' => 'Papua (Jayapura)',
                        'Papua Tengah (Nabire)' => 'Papua Tengah (Nabire)',
                        'Papua Pegunungan (Jayawijaya)' => 'Papua Pegunungan (Jayawijaya)',
                        'Papua Selatan (Merauke)' => 'Papua Selatan (Merauke)',
                        'Papua Barat Daya (Sorong)' => 'Papua Barat Daya (Sorong)',
                    ])
                    ->searchable(),
                
                Forms\Components\Select::make('kota_kabupaten')
                    ->label('Kota/Kabupaten')
                    ->options([
                        'Kota' => 'Kota',
                        'Kabupaten' => 'Kabupaten',
                    ]),
                
                Forms\Components\Textarea::make('alamat_lengkap')
                    ->label('Alamat Lengkap')
                    ->rows(3),
                
                Forms\Components\TextInput::make('email_student')
                    ->label('Email Student.ub.ac.id')
                    ->email()
                    ->suffix('@student.ub.ac.id')
                    ->maxLength(255),
                
                Forms\Components\Select::make('role')
                    ->label('Role')
                    ->options([
                        'mahasiswa' => 'Mahasiswa',
                        'admin' => 'Admin',
                        'spv' => 'Supervisor',
                    ])
                    ->default('mahasiswa')
                    ->required(),
                
                Forms\Components\Select::make('kelompok_id')
                    ->label('Kelompok')
                    ->relationship('kelompok', 'nama_kelompok')
                    ->searchable()
                    ->preload(),
                
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
                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),
                Tables\Columns\TextColumn::make('program_studi')
                    ->label('Program Studi')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('kelompok.nama_kelompok')
                    ->label('Kelompok')
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('kelompok')
                    ->relationship('kelompok', 'nama_kelompok'),
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
            'index' => Pages\ListMahasiswa::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
