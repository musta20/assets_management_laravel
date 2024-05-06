<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayVendor = SeederDataSet::VenderBrandsArray();

            Vendor::factory()
            ->count(count($arrayVendor))
            ->sequence(fn (Sequence $sequence) => $arrayVendor[$sequence->index])
            ->create();
       
    }
}
