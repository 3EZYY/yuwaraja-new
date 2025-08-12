<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    
    protected static ?string $navigationLabel = 'Edit Profile';
    
    protected static ?string $navigationGroup = 'Admin';
    
    protected static ?int $navigationSort = 2;
    
    protected static ?string $title = 'Edit Profile';

    protected static string $view = 'filament.pages.edit-admin-profile';
    
    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();
        $this->form->fill([
            'name' => $user->name,
            'username' => $user->username ?? '',
            'email' => $user->email,
            'phone' => $user->phone ?? $user->nomor_telepon ?? '',
            'nim' => $user->nim ?? '',
            'program_studi' => $user->program_studi ?? '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Profile')
                    ->description('Update informasi profile Anda')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('username')
                            ->label('Username')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                            
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                            
                        TextInput::make('phone')
                            ->label('Nomor HP')
                            ->tel()
                            ->maxLength(20),
                            
                        TextInput::make('nim')
                            ->label('NIM')
                            ->maxLength(20),
                            
                        Select::make('program_studi')
                            ->label('Program Studi')
                            ->options([
                                'D4 Manajemen Perhotelan' => 'D4 Manajemen Perhotelan',
                                'D3 Keuangan dan Perbankan' => 'D3 Keuangan dan Perbankan',
                                'D3 Administrasi Bisnis' => 'D3 Administrasi Bisnis',
                                'D4 Desain Grafis' => 'D4 Desain Grafis',
                                'D3 Teknologi Informasi' => 'D3 Teknologi Informasi',
                            ])
                            ->required(),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        // Sinkronisasi phone dan nomor_telepon
        if (isset($data['phone'])) {
            $data['nomor_telepon'] = $data['phone'];
        }
        
        $user = Auth::user();
        $user->update($data);

        Notification::make()
            ->title('Profile berhasil diupdate!')
            ->success()
            ->send();
    }
}
