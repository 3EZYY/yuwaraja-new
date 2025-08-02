<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelompokResource\Pages;
use App\Filament\Resources\KelompokResource\RelationManagers;
use App\Models\Kelompok;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KelompokResource extends Resource
{
    protected static ?string $model = Kelompok::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Cluster';

    protected static ?string $slug = 'cluster';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Cluster')
                    ->image()
                    ->disk('public')
                    ->directory('cluster-photos')
                    ->maxSize(2048)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->imageEditor()
                    ->imageEditorAspectRatios(['1:1'])
                    ->helperText('Upload foto untuk cluster (maksimal 2MB, format: JPG, PNG, WEBP)'),
                Forms\Components\TextInput::make('nama_kelompok')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Cluster'),
                Forms\Components\Select::make('spv_id')
                    ->relationship('spv', 'name', fn ($query) => $query->where('role', 'spv'))
                    ->searchable()
                    ->preload()
                    ->label('Penanggung Jawab'),
                Forms\Components\TextInput::make('code')
                    ->label('Kode Cluster')
                    ->required()
                    ->maxLength(5)
                    ->unique(ignoreRecord: true)
                    ->default(fn () => strtoupper(\Illuminate\Support\Str::random(5)))
                    ->reactive()
                    ->afterStateHydrated(function ($component, $state) {
                        if (!$state) {
                            $component->state(strtoupper(\Illuminate\Support\Str::random(5)));
                        }
                    })
                    ->suffixAction(
                        \Filament\Forms\Components\Actions\Action::make('generate')
                            ->icon('heroicon-o-arrow-path')
                            ->tooltip('Generate Ulang')
                            ->action(function ($state, $set) {
                                $set('code', strtoupper(\Illuminate\Support\Str::random(5)));
                            })
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kelompok')
                    ->searchable()
                    ->label('Nama Cluster'),
                Tables\Columns\TextColumn::make('spv.name')
                    ->label('Penanggung Jawab')
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode Cluster')
                    ->copyable()
                    ->copyMessage('Kode disalin!')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MembersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelompoks::route('/'),
            'create' => Pages\CreateKelompok::route('/create'),
            'edit' => Pages\EditKelompok::route('/{record}/edit'),
        ];
    }
}
