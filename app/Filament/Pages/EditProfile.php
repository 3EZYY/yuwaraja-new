<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
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
            'photo' => $user->photo,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Profile')
                    ->description('Update informasi profile Anda')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto Profile')
                            ->image()
                            ->disk('public_uploads')
                            ->directory('profile-pictures')
                            ->imageEditor()
                            ->imageEditorAspectRatios(['1:1'])
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->helperText('Upload foto profile Anda (maksimal 2MB, format: JPG, PNG)')
                            ->columnSpanFull(),
                            
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
                            
                        TextInput::make('program_studi')
                            ->label('Program Studi')
                            ->maxLength(100),
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
