<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard Admin';
    
    protected static ?string $navigationGroup = null;
    
    protected static ?int $navigationSort = 1;
    
    protected static ?string $title = 'Selamat Datang Min ^^';
    
    protected static string $view = 'filament.pages.dashboard';
}