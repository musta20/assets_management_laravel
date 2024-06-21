<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages\CreateVendor;
use App\Filament\Resources\VendorResource\Pages\EditVendor;
use App\Filament\Resources\VendorResource\Pages\ListVendors;
use App\Models\Vendor;
use Filament\Actions\EditAction;
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

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),
                TextInput::make('contact_person')
                    ->label(__('Contact Person'))
                    ->maxLength(255),
                TextInput::make('phone_number')
                    ->label(__('Phone number'))
                    ->tel()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label(__('Email'))
                    ->email()
                    ->maxLength(255),
                TextInput::make('address')
                    ->label(__('address'))
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('contact_person')
                    ->label(__('Contact Person'))
                    ->searchable(),
                TextColumn::make('phone_number')
                    ->label(__('Phone number'))
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                TextColumn::make('address')
                    ->label(__('address'))
                    ->searchable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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
            'index' => ListVendors::route('/'),
            'create' => CreateVendor::route('/create'),
            'edit' => EditVendor::route('/{record}/edit'),
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
