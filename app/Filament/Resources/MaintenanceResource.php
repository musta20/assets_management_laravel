<?php

namespace App\Filament\Resources;

use App\Enums\MaintenanceType;
use App\Filament\Resources\MaintenanceResource\Pages\CreateMaintenance;
use App\Filament\Resources\MaintenanceResource\Pages\EditMaintenance;
use App\Filament\Resources\MaintenanceResource\Pages\ListMaintenances;
use App\Models\Maintenance;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('asset_id')
                    ->label(__('asset'))
                    ->relationship('asset', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('type')
                    ->label(__('Maintenance type'))
                    ->options(MaintenanceType::getValuesAsArray()),
                DatePicker::make('date')
                    ->label(__('date'))
                    ->required(),

                Textarea::make('description')
                    ->label(__('description'))
                    ->columnSpanFull(),

                Select::make('technician_id')
                    ->label(__('technician'))
                    ->relationship('technician', 'name')
                    ->searchable()
                    ->preload(),

                TextInput::make('cost')
                    ->label(__('cost'))
                    ->numeric()
                    ->prefix('$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('technician.name')
                    ->label(__('technician'))
                    ->searchable(),
                TextColumn::make('asset.name')
                    ->label(__('asset'))
                    ->searchable(),
                TextColumn::make('date')
                    ->label(__('date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('type')
                    ->label(__('Maintenance type'))
                    ->formatStateUsing(fn (string $state): string => __($state))
                    ->searchable(),
                TextColumn::make('cost')
                    ->label(__('cost'))
                    ->money()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('created'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('updated'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label(__('deleted'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
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
            'index' => ListMaintenances::route('/'),
            'create' => CreateMaintenance::route('/create'),
            'edit' => EditMaintenance::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
