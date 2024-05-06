<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Locations = Location::get();

        $Venor = Vendor::get();

        $Category = Category::get();

        $AssetsArray = SeederDataSet::AssetsArray();

        $recordNumber = 50;

        $assets = $this->createAssetsRecords($recordNumber, $AssetsArray, $Venor, $Locations, $Category);

        Asset::factory()->sequence(fn (Sequence $sequence) => $assets[$sequence->index])->create();


        //Asset::factory(10)->create();
    }

    private function createAssetsRecords(int $recordNumber,array $AssetsArray, Collection $vendor, Collection $location, Collection $category): array
    {
        $assets = [];

        $asset = $AssetsArray[array_rand($AssetsArray)];

        for ($recordNumber; $recordNumber > 0; $recordNumber--) {

            $assets[] = [
                'name' => $asset['name'],
                'description' => $asset['description'],
                'category_id' => $category->random()->id,
                'location_id' => $location->random()->id,
                'vendor_id' => $vendor->random()->id,
            ];
        }

        return $assets;
    }
}
