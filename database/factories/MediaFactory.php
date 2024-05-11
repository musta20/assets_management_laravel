<?php

namespace Database\Factories;

use App\Enums\MediaType;
use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
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
            'media_type' => $this->faker->randomElement(MediaType::cases())->value,
            'file_name' => $this->faker->word() . '.' . $this->faker->fileExtension(),
            'file_path' => $this->faker->filePath(),
            'description' => $this->faker->sentence(),
        ];
    }
}
