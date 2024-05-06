<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayCategory = SeederDataSet::categoriesArray();
        Category::factory()
        ->count(count($arrayCategory))
        ->sequence(fn (Sequence $sequence) => $arrayCategory[$sequence->index])
        ->create();
    }
}
