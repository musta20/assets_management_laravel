<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Enums\UserPermission;
use App\Filament\Resources\RoleResource;
use App\Models\Permission;
use App\Models\Role;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;


    
protected function handleRecordUpdate(Model $record, array $data): Model
{

   $this->setPermission($record, UserPermission::Users->value, $data['Users']);
   $this->setPermission($record, UserPermission::Categories->value, $data['Categories']);
   $this->setPermission($record, UserPermission::Setting->value, $data['Setting']);
   $this->setPermission($record, UserPermission::Vendors->value, $data['Vendors']);
   $this->setPermission($record, UserPermission::Roles->value, $data['Roles']);
   $this->setPermission($record, UserPermission::Departments->value, $data['Departments']);
   $this->setPermission($record, UserPermission::Locations->value, $data['Locations']);
   $this->setPermission($record, UserPermission::Messages->value, $data['Messages']);
   $this->setPermission($record, UserPermission::Assets->value, $data['Assets']);
   $this->setPermission($record, UserPermission::Maintenances->value, $data['Maintenances']);


    $record->update([
        'name' => $data['name'],
        ]);
 
    return $record;
}



protected function mutateFormDataBeforeFill(array $data): array
{

   $Roel = Role::find($data['id']);
   $data[UserPermission::Users->value] = $Roel->hasPermissionTo(UserPermission::Users->value);
   $data[UserPermission::Setting->value] = $Roel->hasPermissionTo(UserPermission::Setting->value);
   $data[UserPermission::Vendors->value] = $Roel->hasPermissionTo(UserPermission::Vendors->value);

   $data[UserPermission::Roles->value] = $Roel->hasPermissionTo(UserPermission::Roles->value);
   $data[UserPermission::Departments->value] = $Roel->hasPermissionTo(UserPermission::Departments->value);
   $data[UserPermission::Locations->value] = $Roel->hasPermissionTo(UserPermission::Locations->value);
   $data[UserPermission::Messages->value] = $Roel->hasPermissionTo(UserPermission::Messages->value);

   $data[UserPermission::Assets->value] = $Roel->hasPermissionTo(UserPermission::Assets->value);
   $data[UserPermission::Categories->value] = $Roel->hasPermissionTo(UserPermission::Categories->value);
   $data[UserPermission::Maintenances->value] = $Roel->hasPermissionTo(UserPermission::Maintenances->value);

 
    return $data;
}

protected function setPermission(Role $record, string $permission,bool $state )
{
    if($state){
        $record->givePermissionTo($permission);
    }else{
        $record->revokePermissionTo($permission);
    }
 
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
