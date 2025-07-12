<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Kelompok;
use App\Models\Tugas;
use App\Models\Pengumuman;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Mahasiswa', User::where('role', 'mahasiswa')->count())
                ->description('Mahasiswa Aktif')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success'),
            
            Stat::make('Total Kelompok', Kelompok::count())
                ->description('Kelompok Terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Total Tugas', Tugas::count())
                ->description('Tugas Aktif')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning'),

            Stat::make('Total Pengumuman', Pengumuman::count())
                ->description('Pengumuman Aktif')
                ->descriptionIcon('heroicon-m-megaphone')
                ->color('danger'),
        ];
    }
}
