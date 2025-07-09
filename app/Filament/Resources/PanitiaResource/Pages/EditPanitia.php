<?php

namespace App\Filament\Resources\PanitiaResource\Pages;

use App\Filament\Resources\PanitiaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPanitia extends EditRecord
{
    protected static string $resource = PanitiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
