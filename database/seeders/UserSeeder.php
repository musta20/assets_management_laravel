<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $department = Department::where('name', 'المديرية العامة')->firstOrFail();
        $ItDepartment = Department::where('name', 'تقنية المعلومات')->firstOrFail();
        $allDeoartment = Department::get();

        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'department_id' => $department->id,

        ]);

        $musta = User::factory()->create([
            'name' => 'musta',
            'email' => 'musta@musta.com',
            'password' => bcrypt('musta'),

        ]);

        $MANGER = Role::findByName(UserRole::MANAGER->value);
        $adminRole = Role::findByName(UserRole::ADMIN->value);

        $musta->assignRole($MANGER);
        $admin->assignRole($adminRole);

        User::factory()->count(10)->withDepartment($allDeoartment->random()->id)->withRole(UserRole::EMPLOYEE->value)->create();
        User::factory()->count(10)->withDepartment($allDeoartment->random()->id)->withRole(UserRole::MANAGER->value)->create();
        User::factory()->count(10)->withDepartment($ItDepartment->id)->withRole(UserRole::TECHNICIAN->value)->create();

        // excite artisan command to sync permissions
        Artisan::call('permissions:sync');
        Artisan::call('permissions:sync -P');
    }
}
