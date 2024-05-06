<?php

namespace Database\Seeders;

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


 
    }
}
