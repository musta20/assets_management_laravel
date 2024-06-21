<?php

use App\Enums\MaintenanceType;
use App\Enums\UserRole;
use App\Filament\Resources\MaintenanceResource;
use App\Models\Asset;
use App\Models\Maintenance;
use App\Models\User;
use Filament\Tables\Actions\DeleteBulkAction;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Livewire\livewire;

it('allows creating a maintenance record', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $asset = Asset::factory()->create();
    $technician = User::factory()->create();
    $maintenance_Data = [
        'asset_id' => $asset->id,
        'type' => MaintenanceType::PREVENTIVE->value,
        'date' => now()->format('Y-m-d'),
        'description' => 'Test maintenance record',
        'technician_id' => $technician->id,
        'cost' => 100.50,
    ];

    livewire(MaintenanceResource\Pages\CreateMaintenance::class)
        ->fillForm($maintenance_Data)
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('maintenances', $maintenance_Data);
});

it('allows editing a maintenance record', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $maintenance = Maintenance::factory()->create();

    livewire(MaintenanceResource\Pages\EditMaintenance::class, [
        'record' => $maintenance->id,
    ])
        ->fillForm([
            'type' => MaintenanceType::CORRECTIVE->value,
            'description' => 'Updated description',
            'cost' => 150.00,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    assertDatabaseHas('maintenances', [
        'id' => $maintenance->id,
        'type' => MaintenanceType::CORRECTIVE->value,
        'description' => 'Updated description',
        'cost' => 150.00,
    ]);
});

it('allows deleting a maintenance record', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $maintenance = Maintenance::factory()->create();

    livewire(MaintenanceResource\Pages\EditMaintenance::class,
        ['record' => $maintenance->id])
        ->callAction(DeleteBulkAction::class)
        ->assertSuccessful();

    assertSoftDeleted('maintenances', ['id' => $maintenance->id]);
});
