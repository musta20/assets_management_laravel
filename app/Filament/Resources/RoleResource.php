<?php

namespace App\Filament\Resources;

use App\Enums\UserPermission;
use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Forms\Components\permissionToggle;
use App\Models\Role;
use App\Tables\Columns\RelationCheckboxColumn;
use App\Tables\Columns\StatusSwitcher;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(26),


                permissionToggle::make(UserPermission::Users->value),
                permissionToggle::make(UserPermission::Setting->value),
                permissionToggle::make(UserPermission::Vendors->value),
                permissionToggle::make(UserPermission::Roles->value),
                permissionToggle::make(UserPermission::Departments->value),
                permissionToggle::make(UserPermission::Locations->value),
                permissionToggle::make(UserPermission::Messages->value),
                permissionToggle::make(UserPermission::Assets->value),
                permissionToggle::make(UserPermission::Categories->value),
                permissionToggle::make(UserPermission::Maintenances->value),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),

                // ->beforeStateUpdated(function ($record, $state) {
                //     // Runs before the state is saved to the database.
                //    // dd($state);
                //    $state= $record->hasPermissionTo(UserPermission::Setting->value);
                // })
                // ->afterStateUpdated(function ($record, $state) {
                //     // Runs after the state is saved to the database.
                // })

                StatusSwitcher::make(UserPermission::Users->value),
                StatusSwitcher::make(UserPermission::Setting->value),
                StatusSwitcher::make(UserPermission::Vendors->value),
                StatusSwitcher::make(UserPermission::Roles->value),
                StatusSwitcher::make(UserPermission::Departments->value),
                StatusSwitcher::make(UserPermission::Locations->value),
                StatusSwitcher::make(UserPermission::Messages->value),
                StatusSwitcher::make(UserPermission::Assets->value),
                StatusSwitcher::make(UserPermission::Categories->value),
                StatusSwitcher::make(UserPermission::Maintenances->value),

            //   IconColumn::make('hasUsersPermission')
              // ->icon(fn (Role $record): string => $record->hasPermissionTo(UserPermission::Users->value) 
              //? 'heroicon-o-user-group' : 'heroicon-o-x-circle')
              // ->boolean(),
           ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
              
                // ->using(function (Model $record, array $data): Model {
                //     $record->update([
                //         'name' => $data['name'].' updated',
                //     ]);
             
                //     return $record;
                // })

    // ->mutateFormDataUsing(function (array $data): array {
       
    //     dd($data);
 
    //     return $data;
    // })

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
            //
        ];
    }

//     public static function getActions(): array
// {
//     return [
//         EditAction::make()->mutateFormDataUsing(function (array $data): array {
//             // Modify form data before saving
//            // $data['updated_at'] = now(); // Example: Update timestamp
//            dd($data);
//             return $data;
//         }),
//     ];
// }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
