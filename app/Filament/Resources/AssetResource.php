<?php

namespace App\Filament\Resources;

use App\Enums\AssetsStatus;
use App\Enums\DepreciationMethod;
use App\Enums\ItemType;
use App\Filament\Resources\AssetResource\Pages\CreateAsset;
use App\Filament\Resources\AssetResource\Pages\EditAsset;
use App\Filament\Resources\AssetResource\Pages\ListAssets;
use App\Filament\Resources\AssetResource\Pages\ViewAsset;
use App\Filament\Resources\AssetResource\RelationManagers\MediaRelationManager;
use App\Infolists\Components\Barcodeentite;
use App\Models\Asset;
use App\Tables\Columns\BarcodeColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
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

                Select::make('category_id')
                    ->label(__('Category'))
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                Select::make('location_id')
                    ->label(__('Location'))
                    ->relationship('location', 'name')
                    ->searchable()
                    ->preload(),
                Select::make('vendor_id')
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

                TextInput::make('warranty_information')
                    ->label(__('warranty_information'))
                    ->maxLength(255),
                Select::make('depreciation_method')
                    ->label(__('depreciation_method'))
                    ->options(DepreciationMethod::getValuesAsArray()),

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

                BarcodeColumn::make('barcode')
                    ->label(__('barcode')),
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
                TrashedFilter::make(),
            ])
            ->actions([

                EditAction::make(),
                ViewAction::make(),

            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {

        return $infolist
            ->schema([

                TextEntry::make('name')
                    ->label(__('name')),

                TextEntry::make('category.name')
                    ->label(__('Category')),

                Barcodeentite::make('barcode')
                    ->label(__('barcode')),
                TextEntry::make('location.name')
                    ->label(__('Location')),
                TextEntry::make('vendor.name')
                    ->label(__('vendor')),
                TextEntry::make('status')
                    ->formatStateUsing(fn (string $state): string => __($state))
                    ->label(__('status')),
                TextEntry::make('purchase_date')
                    ->label(__('purchase_date')),
                TextEntry::make('item_type')
                    ->formatStateUsing(fn (string $state): string => __($state))
                    ->label(__('item_type')),
                TextEntry::make('purchase_price')
                    ->label(__('purchase_price')),
                TextEntry::make('serial_number')
                    ->label(__('serial_number')),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            MediaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAssets::route('/'),
            'create' => CreateAsset::route('/create'),
            'view' => ViewAsset::route('/{record}'),
            'edit' => EditAsset::route('/{record}/edit'),
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
