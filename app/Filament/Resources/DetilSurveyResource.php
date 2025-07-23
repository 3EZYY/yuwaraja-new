<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetilSurveyResource\Pages;
use App\Models\DetilSurvey;
use App\Models\MasterSurvey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;

class DetilSurveyResource extends Resource
{
    protected static ?string $model = DetilSurvey::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationLabel = 'Pertanyaan Survey';

    protected static ?string $modelLabel = 'Pertanyaan';

    protected static ?string $pluralModelLabel = 'Pertanyaan';

    protected static ?string $navigationGroup = 'Survey Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_master_survey')
                    ->label('Survey')
                    ->relationship('masterSurvey', 'judul_survey')
                    ->required()
                    ->searchable()
                    ->preload(),

                Textarea::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),

                Select::make('tipe_pertanyaan')
                    ->label('Tipe Pertanyaan')
                    ->options([
                        'text' => 'Text Input',
                        'textarea' => 'Text Area',
                        'radio' => 'Radio Button (Pilihan Tunggal)',
                        'checkbox' => 'Checkbox (Pilihan Ganda)',
                        'select' => 'Select Dropdown',
                    ])
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('opsi_jawaban', null)),

                Repeater::make('opsi_jawaban')
                    ->label('Opsi Jawaban')
                    ->schema([
                        TextInput::make('value')
                            ->label('Nilai')
                            ->required(),
                        TextInput::make('label')
                            ->label('Label')
                            ->required(),
                    ])
                    ->visible(fn (callable $get) => in_array($get('tipe_pertanyaan'), ['radio', 'checkbox', 'select']))
                    ->columnSpanFull()
                    ->minItems(2)
                    ->maxItems(10)
                    ->addActionLabel('Tambah Opsi'),

                Toggle::make('wajib_diisi')
                    ->label('Wajib Diisi')
                    ->default(false),

                TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->default(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('masterSurvey.judul_survey')
                    ->label('Survey')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    })
                    ->searchable(),

                BadgeColumn::make('tipe_pertanyaan')
                    ->label('Tipe')
                    ->colors([
                        'primary' => 'text',
                        'success' => 'textarea',
                        'warning' => 'radio',
                        'danger' => 'checkbox',
                        'info' => 'select',
                    ])
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'text' => 'Text',
                        'textarea' => 'Text Area',
                        'radio' => 'Radio',
                        'checkbox' => 'Checkbox',
                        'select' => 'Select',
                        default => ucfirst($state)
                    }),

                ToggleColumn::make('wajib_diisi')
                    ->label('Wajib')
                    ->disabled(),

                TextColumn::make('urutan')
                    ->label('Urutan')
                    ->sortable()
                    ->badge(),

                TextColumn::make('opsi_count')
                    ->label('Jumlah Opsi')
                    ->state(function ($record) {
                        if (in_array($record->tipe_pertanyaan, ['radio', 'checkbox', 'select'])) {
                            return is_array($record->opsi_jawaban) ? count($record->opsi_jawaban) : 0;
                        }
                        return '-';
                    })
                    ->badge()
                    ->color('info'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('id_master_survey')
                    ->label('Survey')
                    ->relationship('masterSurvey', 'judul_survey')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('tipe_pertanyaan')
                    ->label('Tipe Pertanyaan')
                    ->options([
                        'text' => 'Text Input',
                        'textarea' => 'Text Area',
                        'radio' => 'Radio Button',
                        'checkbox' => 'Checkbox',
                        'select' => 'Select Dropdown',
                    ]),

                SelectFilter::make('wajib_diisi')
                    ->label('Wajib Diisi')
                    ->options([
                        '1' => 'Ya',
                        '0' => 'Tidak',
                    ]),
            ])
            ->actions([
                ViewAction::make()
                    ->label('Lihat'),
                EditAction::make()
                    ->label('Edit'),
                DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ])
            ->defaultSort('urutan', 'asc');
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
            'index' => Pages\ListDetilSurveys::route('/'),
            'create' => Pages\CreateDetilSurvey::route('/create'),
            'view' => Pages\ViewDetilSurvey::route('/{record}'),
            'edit' => Pages\EditDetilSurvey::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function canViewAny(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canEdit($record): bool
    {
        return Auth::user()?->role === 'admin';
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->role === 'admin';
    }
}