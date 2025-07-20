<?php

namespace App\Filament\Resources\KelompokResource\Pages;

use App\Filament\Resources\KelompokResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKelompok extends CreateRecord
{
    protected static string $resource = KelompokResource::class;

    public function getTitle(): string
    {
        return 'Buat Cluster';
    }

    public function getBreadcrumbs(): array
    {
        return [
            '/admin' => 'Dashboard',
            '/admin/dashboard/cluster' => 'Cluster',
            '' => 'Buat',
        ];
    }
}
