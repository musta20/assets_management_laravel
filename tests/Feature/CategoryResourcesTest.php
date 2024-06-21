<?php

use App\Enums\UserRole;
use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use App\Models\User;
use Filament\Tables\Actions\DeleteBulkAction;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Livewire\livewire;

it('allows creating a category', function () {

    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();

    $this->actingAs($user);

    livewire(CategoryResource\Pages\CreateCategory::class)
        ->fillForm([
            'name' => 'Test Category',
            'description' => 'This is a test category.',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('categories', [
        'name' => 'Test Category',
        'description' => 'This is a test category.',
    ]);
});

it('allows editing a category', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();

    $this->actingAs($user);
    $category = Category::factory()->create();

    livewire(CategoryResource\Pages\EditCategory::class, [
        'record' => $category->id,
    ])
        ->fillForm([
            'name' => 'Updated Category',
            'description' => 'Updated description.',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Updated Category',
        'description' => 'Updated description.',
    ]);
});

it('allows deleting a category', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();

    $this->actingAs($user);
    $category = Category::factory()->create();

    livewire(CategoryResource\Pages\EditCategory::class,
        ['record' => $category->getRouteKey()]
    )

        ->callAction(DeleteBulkAction::class)
        ->assertSuccessful();

    assertSoftDeleted('categories', ['id' => $category->id]);
});
