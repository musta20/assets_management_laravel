<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $DepartmentsArray = SeederDataSet::DepartmentsArray();

        //dd($DepartmentsArray[0]);

        Department::factory()->count(count($DepartmentsArray))
            ->sequence(fn (Sequence $sequence) => $DepartmentsArray[$sequence->index])
            ->create();
    }
}
