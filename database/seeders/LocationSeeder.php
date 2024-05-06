<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $LocationsArray = SeederDataSet::LocationsArray();

        Location::factory()
            ->count(count($LocationsArray))
            ->sequence(fn (Sequence $sequence) => $LocationsArray[$sequence->index])
            ->create();
    }
}
