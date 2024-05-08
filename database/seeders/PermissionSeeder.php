<?php

namespace Database\Seeders;

use App\Enums\UserPermission;
use App\Enums\UserRole;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Admin = Role::create(['name' => UserRole::ADMIN->value]);

        $Manger = Role::create(['name' => UserRole::MANAGER->value]);

        $Employee = Role::create(['name' => UserRole::EMPLOYEE->value]);

        $Technician = Role::create(['name' => UserRole::TECHNICIAN->value]);


        $Categories = Permission::create(['name' => UserPermission::Categories->value]);

        $Setting = Permission::create(['name' => UserPermission::Setting->value]);

        $Users = Permission::create(['name' => UserPermission::Users->value]);

        $Assets = Permission::create(['name' => UserPermission::Assets->value]);

        $Departments = Permission::create(['name' => UserPermission::Departments->value]);

        $Messages = Permission::create(['name' => UserPermission::Messages->value]);

        $Locations = Permission::create(['name' => UserPermission::Locations->value]);

        $Maintenances = Permission::create(['name' => UserPermission::Maintenances->value]);

        $Vendors = Permission::create(['name' => UserPermission::Vendors->value]);

        $Roles = Permission::create(['name' => UserPermission::Roles->value]);

      

        
        $Admin->givePermissionTo($Setting);
        $Admin->givePermissionTo($Categories);
        $Admin->givePermissionTo($Users);
        $Admin->givePermissionTo($Assets);
        $Admin->givePermissionTo($Departments);
        $Admin->givePermissionTo($Locations);
        $Admin->givePermissionTo($Maintenances);
        $Admin->givePermissionTo($Roles);
        $Admin->givePermissionTo($Vendors);
        $Admin->givePermissionTo($Messages);


        $Manger->givePermissionTo($Categories);
        $Manger->givePermissionTo($Assets);
        $Manger->givePermissionTo($Departments);
        $Manger->givePermissionTo($Locations);
        $Manger->givePermissionTo($Messages);
        $Manger->givePermissionTo($Vendors);
        $Manger->givePermissionTo($Maintenances);
    
        $Employee->givePermissionTo($Messages);
        $Employee->givePermissionTo($Assets);


        $Technician->givePermissionTo($Messages);
        $Technician->givePermissionTo($Maintenances);
        $Technician->givePermissionTo($Assets);
 
    }
}
