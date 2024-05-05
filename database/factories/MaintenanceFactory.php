<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asset_id' => Asset::factory(),
            'date' => $this->faker->date(),
            'type' => $this->faker->randomElement(['preventive', 'corrective']),
            'description' => $this->faker->sentence(),
            'technician_id' => User::factory(),
            'cost' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
