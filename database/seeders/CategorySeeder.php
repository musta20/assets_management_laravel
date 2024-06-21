<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $newCategory = Category::factory()
            ->count(count($arrayCategory))
            ->sequence(fn (Sequence $sequence) => $arrayCategory[$sequence->index])
            ->create();

        $firstchild = [];

        $scandchild = [];

        for ($index = 0; $index < count($newCategory); $index++) {

            if (count($newCategory) / 3 >= $index + 1) {

                $firstchild[] = $newCategory[$index];
            }

            if (count($scandchild) < 3) {

                if (! in_array($newCategory[$index], $firstchild)) {
                    $scandchild[] = $newCategory[$index];
                }
            }
        }

        foreach ($firstchild as $key => $value) {

            if ($scandchild[$key] != null) {
                $value->update([
                    'parent_id' => $scandchild[$key]->id,
                ]);
            }
        }

        // foreach ($newCategory as $key => $category) {

        //     if($key < count($firstchild)){
        //     $category->update([
        //         'parent_id' => $firstchild[$key],
        //     ]);

        //     }

        // }
        // 1 2 3
        // 4 5 6
        // 7 8 9
        //
        //
        //

    }
}
