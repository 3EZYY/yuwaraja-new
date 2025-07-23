<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HasilSurveyResource\Pages;
use App\Models\HasilSurvey;
use App\Models\MasterSurvey;
use App\Models\DetilSurvey;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\ExportAction;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;

class HasilSurveyResource extends Resource
{
    protected static ?string $model = HasilSurvey::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static ?string $navigationLabel = 'Hasil Survey';

    protected static ?string $modelLabel = 'Hasil Survey';

    protected static ?string $pluralModelLabel = 'Hasil Survey';

    protected static ?string $navigationGroup = 'Survey Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_master_survey')
                    ->label('Survey')
                    ->relationship('masterSurvey', 'judul_survey')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('id_detil_survey', null)),

                Select::make('id_detil_survey')
                    ->label('Pertanyaan')
                    ->options(function (callable $get) {
                        $surveyId = $get('id_master_survey');
                        if (!$surveyId) {
                            return [];
                        }
                        return DetilSurvey::where('id_master_survey', $surveyId)
                            ->pluck('pertanyaan', 'id_detil_survey');
                    })
                    ->required()
                    ->searchable(),

                Select::make('user_id')
                    ->label('Responden')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Textarea::make('jawaban')
                    ->label('Jawaban')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
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

                TextColumn::make('detilSurvey.pertanyaan')
                    ->label('Pertanyaan')
                    ->limit(40)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 40) {
                            return null;
                        }
                        return $state;
                    })
                    ->searchable(),

                TextColumn::make('user.name')
                    ->label('Responden')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('user.nim')
                    ->label('NIM')
                    ->searchable(),

                TextColumn::make('jawaban')
                    ->label('Jawaban')
                    ->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    })
                    ->searchable(),

                TextColumn::make('detilSurvey.tipe_pertanyaan')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'text' => 'primary',
                        'textarea' => 'success',
                        'radio' => 'warning',
                        'checkbox' => 'danger',
                        'select' => 'info',
                        default => 'gray'
                    })
                    ->formatStateUsing(fn (string $state): string => match($state) {
                        'text' => 'Text',
                        'textarea' => 'Area',
                        'radio' => 'Radio',
                        'checkbox' => 'Check',
                        'select' => 'Select',
                        default => ucfirst($state)
                    }),

                TextColumn::make('created_at')
                    ->label('Dijawab Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('id_master_survey')
                    ->label('Survey')
                    ->relationship('masterSurvey', 'judul_survey')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('user_id')
                    ->label('Responden')
                    ->relationship('user', 'name')
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
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            fn (Builder $query, $value): Builder => $query->whereHas(
                                'detilSurvey',
                                fn (Builder $query): Builder => $query->where('tipe_pertanyaan', $value)
                            )
                        );
                    }),
            ])
            ->actions([
                ViewAction::make()
                    ->label('Lihat'),
                DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Hapus Terpilih'),
                ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export')
                    ->label('Export Data')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function () {
                        // This would be implemented with a proper export functionality
                        // For now, just show a notification
                        \Filament\Notifications\Notification::make()
                            ->title('Export akan segera tersedia')
                            ->info()
                            ->send();
                    }),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListHasilSurveys::route('/'),
            'view' => Pages\ViewHasilSurvey::route('/{record}'),
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
        return false; // Hasil survey tidak dibuat manual, tapi dari responden
    }

    public static function canEdit($record): bool
    {
        return false; // Hasil survey tidak boleh diedit
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->role === 'admin';
    }
}