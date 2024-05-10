<?php

namespace App\Filament\Resources;

use App\Enums\AssetsStatus;
use App\Enums\DepreciationMethod;
use App\Enums\ItemType;
use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\SelectColumn;
use Filament\Tables\Columns\SelectColumn as ColumnsSelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {



        return $form
            ->schema([
                TextInput::make('name')
                ->label(__('name'))
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label(__('description'))
                    ->columnSpanFull(),

                Select::make('category')
                    ->label(__('Category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                Select::make('location')
                ->label(__('Location'))
                    ->relationship('location', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('vendor')
                ->label(__('vendor'))

                    ->relationship('vendor', 'name')
                    ->searchable()
                    ->preload(),

                Select::make('status')
                    ->label(__('status'))
                    ->options(AssetsStatus::getValuesAsArray()),


                DatePicker::make('purchase_date')
                ->label(__('purchase_date'))
                    ->required(),
                Select::make('item_type')
                    ->label(__('item_type'))
                    ->options(ItemType::getValuesAsArray()),

                TextInput::make('purchase_price')
                    ->label(__('purchase_price'))
                    ->required()
                    ->numeric(),
                TextInput::make('serial_number')
                    ->label(__('serial_number'))
                    ->maxLength(255),
                TextInput::make('warranty_information')
                    ->label(__('warranty_information'))
                    ->maxLength(255),
                    Select::make('depreciation_method')
                    ->label(__('depreciation_method'))
                    ->options(DepreciationMethod::getValuesAsArray()),


            

                TextInput::make('barcode')
                    ->label(__('barcode'))
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->label(__('name'))
                    ->searchable(),
                TextColumn::make('category.name')
                
                    ->label(__('Category'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('location.name')
                    ->label(__('Location'))


                    ->searchable(),
                TextColumn::make('vendor.name')
                    ->label(__('vendor'))
                    ->searchable(),

                TextColumn::make('status')
                    ->label(__('status'))
                    ->formatStateUsing(fn (string $state): string => __($state))

                    ->searchable(),
                TextColumn::make('purchase_date')
                    ->label(__('purchase_date'))
                    ->date()
                    ->sortable(),
                TextColumn::make('item_type')
                ->formatStateUsing(fn (string $state): string => __($state))

                    ->label(__('item_type'))
                    ->searchable(),
                TextColumn::make('purchase_price')
                    ->label(__('purchase_price'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('serial_number')
                    ->label(__('serial_number'))
                    ->searchable(),
    
                TextColumn::make('barcode')
                    ->label(__('barcode'))
                    ->searchable(),
                TextColumn::make('deleted_at')
                    ->label(__('deleted_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label(__('created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
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
