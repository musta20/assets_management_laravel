<?php

use App\Enums\UserRole;
use App\Filament\Resources\LocationResource;
use App\Models\Location;
use App\Models\User;
use Filament\Tables\Actions\DeleteBulkAction;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Livewire\livewire;

it('allows creating a location', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);

    livewire(LocationResource\Pages\CreateLocation::class)
        ->fillForm([
            'name' => 'Test Location',
            'description' => 'This is a test location.',
            'address' => '123 Test St',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('locations', [
        'name' => 'Test Location',
        'description' => 'This is a test location.',
        'address' => '123 Test St',
    ]);
});

it('allows editing a location', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $location = Location::factory()->create();

    livewire(LocationResource\Pages\EditLocation::class, [
        'record' => $location->id,
    ])
        ->fillForm([
            'name' => 'Updated Location',
            'description' => 'Updated description.',
            'address' => '456 Updated St',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    assertDatabaseHas('locations', [
        'id' => $location->id,
        'name' => 'Updated Location',
        'description' => 'Updated description.',
        'address' => '456 Updated St',
    ]);
});

it('allows deleting a location', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $location = Location::factory()->create();

    livewire(LocationResource\Pages\EditLocation::class,
        ['record' => $location->getRouteKey()])
        ->callAction(DeleteBulkAction::class)
        ->assertSuccessful();

    assertSoftDeleted('locations', ['id' => $location->id]);
});
