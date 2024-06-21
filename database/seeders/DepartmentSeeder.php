<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $DepartmentsArray = SeederDataSet::departmentsArray();

        Department::factory()->count(count($DepartmentsArray))
            ->sequence(fn (Sequence $sequence) => $DepartmentsArray[$sequence->index])
            ->create();
    }
}
