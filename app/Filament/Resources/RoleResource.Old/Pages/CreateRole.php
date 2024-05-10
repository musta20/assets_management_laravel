<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Enums\UserPermission;
use App\Filament\Resources\RoleResource;
use App\Models\Role;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $role  = static::getModel()::query()->create([
            'name' => $data['name'],
        ]);

        
        $this->setPermission($role, UserPermission::Users->value, $data['Users']);
        $this->setPermission($role, UserPermission::Categories->value, $data['Categories']);
        $this->setPermission($role, UserPermission::Setting->value, $data['Setting']);
        $this->setPermission($role, UserPermission::Vendors->value, $data['Vendors']);
        $this->setPermission($role, UserPermission::Roles->value, $data['Roles']);
        $this->setPermission($role, UserPermission::Departments->value, $data['Departments']);
        $this->setPermission($role, UserPermission::Locations->value, $data['Locations']);
        $this->setPermission($role, UserPermission::Messages->value, $data['Messages']);
        $this->setPermission($role, UserPermission::Assets->value, $data['Assets']);
        $this->setPermission($role, UserPermission::Maintenances->value, $data['Maintenances']);


        return $role ;
    }

    protected function setPermission(Role $record, string $permission,bool $state )
{
    if($state){
        $record->givePermissionTo($permission);
    }else{
        $record->revokePermissionTo($permission);
    }
 
}

}
