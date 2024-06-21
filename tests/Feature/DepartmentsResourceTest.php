<?php

use App\Enums\UserRole;
use App\Filament\Resources\DepartmentResource;
use App\Models\Department;
use App\Models\User;
use Filament\Tables\Actions\DeleteBulkAction;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Livewire\livewire;

it('allows creating a department', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);

    livewire(DepartmentResource\Pages\CreateDepartment::class)
        ->fillForm([
            'name' => 'Test Department',
            'description' => 'This is a test department.',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('departments', [
        'name' => 'Test Department',
        'description' => 'This is a test department.',
    ]);
});

it('allows editing a department', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $department = Department::factory()->create();

    livewire(DepartmentResource\Pages\EditDepartment::class, [
        'record' => $department->id,
    ])
        ->fillForm([
            'name' => 'Updated Department',
            'description' => 'Updated description.',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    assertDatabaseHas('departments', [
        'id' => $department->id,
        'name' => 'Updated Department',
        'description' => 'Updated description.',
    ]);
});

it('allows deleting a department', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $department = Department::factory()->create();

    livewire(DepartmentResource\Pages\EditDepartment::class,
        ['record' => $department->getRouteKey()])
        ->callAction(DeleteBulkAction::class)
        ->assertSuccessful();

    assertSoftDeleted('departments', ['id' => $department->id]);
});
