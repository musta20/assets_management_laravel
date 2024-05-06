<?php

namespace Database\Factories;

use App\Enums\AssetsStatus;
use App\Models\Category;
use App\Models\Location;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'category_id' => Category::factory(), // Create a related category
            'location_id' => Location::factory(), // Create a related location
            'vendor_id' => Vendor::factory(), // Create a related vendor
            'status' => $this->faker->randomElement(AssetsStatus::cases()),
            'purchase_date' => $this->faker->date(),
            'purchase_price' => $this->faker->randomFloat(2, 100, 10000),
            'serial_number' => $this->faker->randomNumber(9),
            'warranty_information' => $this->faker->sentence(),
            'depreciation_method' => $this->faker->randomElement(['straight-line', 'declining-balance']),
        ];
    }
}
