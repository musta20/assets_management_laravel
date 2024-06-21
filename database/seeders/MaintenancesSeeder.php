<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\Asset;
use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class MaintenancesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asset = Asset::get();

        $tech = User::role(UserRole::TECHNICIAN->value)->get();
        Maintenance::factory()->count($asset->count() / 2)
            ->sequence(fn (Sequence $sequence) => [
                'asset_id' => $asset->random()->id,
                'technician_id' => $tech->random()->id,
            ])
            ->create();

    }
}
