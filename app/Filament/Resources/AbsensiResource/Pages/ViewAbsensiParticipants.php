<?php

namespace App\Filament\Resources\AbsensiResource\Pages;

use App\Filament\Resources\AbsensiResource;
use App\Models\Absensi;
use App\Models\User;
use Filament\Resources\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class ViewAbsensiParticipants extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string $resource = AbsensiResource::class;

    protected static string $view = 'filament.resources.absensi-resource.pages.view-absensi-participants';

    public Absensi $record;

    public function mount(Absensi $record): void
    {
        $this->record = $record;
    }

    public function getTitle(): string
    {
        return "Peserta Absensi: {$this->record->judul}";
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->where('role', 'mahasiswa')
                    ->with(['kelompok'])
                    ->leftJoin('absensi_mahasiswa', function ($join) {
                        $join->on('users.id', '=', 'absensi_mahasiswa.user_id')
                             ->where('absensi_mahasiswa.absensi_id', $this->record->id);
                    })
                    ->select('users.*', 'absensi_mahasiswa.waktu_absen')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Mahasiswa')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('kelompok.nama_kelompok')
                    ->label('Kelompok')
                    ->sortable(),

                BadgeColumn::make('status_absensi')
                    ->label('Status Absensi')
                    ->getStateUsing(function (User $record): string {
                        return $record->waktu_absen ? 'Hadir' : 'Belum Absen';
                    })
                    ->colors([
                        'success' => 'Hadir',
                        'danger' => 'Belum Absen',
                    ]),

                TextColumn::make('waktu_absen')
                    ->label('Waktu Absen')
                    ->dateTime('d/m/Y H:i:s')
                    ->placeholder('-')
                    ->sortable(),

                BadgeColumn::make('ketepatan')
                    ->label('Ketepatan')
                    ->getStateUsing(function (User $record): ?string {
                        if (!$record->waktu_absen) {
                            return null;
                        }
                        
                        $waktuAbsen = \Carbon\Carbon::parse($record->waktu_absen);
                        $isOnTime = $waktuAbsen->between(
                            $this->record->jam_mulai,
                            $this->record->jam_selesai
                        );
                        
                        return $isOnTime ? 'Tepat Waktu' : 'Terlambat';
                    })
                    ->colors([
                        'success' => 'Tepat Waktu',
                        'warning' => 'Terlambat',
                    ])
                    ->placeholder('-'),
            ])
            ->filters([
                SelectFilter::make('status_absensi')
                    ->label('Status Absensi')
                    ->options([
                        'hadir' => 'Hadir',
                        'belum_absen' => 'Belum Absen',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'] === 'hadir',
                            fn (Builder $query): Builder => $query->whereNotNull('absensi_mahasiswa.waktu_absen'),
                        )->when(
                            $data['value'] === 'belum_absen',
                            fn (Builder $query): Builder => $query->whereNull('absensi_mahasiswa.waktu_absen'),
                        );
                    }),

                SelectFilter::make('kelompok_id')
                    ->label('Kelompok')
                    ->relationship('kelompok', 'nama_kelompok'),
            ])
            ->defaultSort('name');
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label('Kembali')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray'),
        ];
    }
}