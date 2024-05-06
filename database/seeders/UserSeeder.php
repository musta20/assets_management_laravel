<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department  = Department::where('name', 'المديرية العامة')->firstOrFail();
         
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'department_id' => $department->id

        ]);

        $adminRole = Role::findByName(UserRole::ADMIN->value);

        $admin->assignRole($adminRole);
        User::factory()->count(10)->withRole(UserRole::EMPLOYEE->value)->create();
        User::factory()->count(10)->withRole(UserRole::MANAGER->value)->create();
        User::factory()->count(10)->withRole(UserRole::TECHNICIAN->value)->create();

    }
}
