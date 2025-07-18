<?php

namespace App\Filament\Resources\AdminProfileResource\Pages;

use App\Filament\Resources\AdminProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Auth;

class ListAdminProfiles extends ListRecords
{
    protected static string $resource = AdminProfileResource::class;
    
    protected static ?string $title = 'Profile Admin';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('edit_profile')
                ->label('Edit Profile')
                ->icon('heroicon-o-pencil-square')
                ->url(fn () => AdminProfileResource::getUrl('edit', ['record' => Auth::id()]))
                ->color('primary'),
        ];
    }
    
    public function mount(): void
    {
        parent::mount();
        
        // Redirect langsung ke halaman edit jika hanya ada satu record (user yang login)
        $this->redirect(AdminProfileResource::getUrl('edit', ['record' => Auth::id()]));
    }
}
