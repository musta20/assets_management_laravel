<?php

use App\Enums\AssetsStatus;
use App\Enums\DepreciationMethod;
use App\Enums\ItemType;
use App\Enums\UserRole;
use App\Filament\Resources\AssetResource\Pages\CreateAsset;
use App\Filament\Resources\AssetResource\Pages\EditAsset;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\User;
use App\Models\Vendor;
use Filament\Tables\Actions\DeleteAction;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertSoftDeleted;
use function Pest\Livewire\livewire;

it('allows users to access asset resource', function () {
    $user = User::factory()->create();
    $user->assignRole(UserRole::ADMIN->value);
    actingAs($user)->get('/admin/assets')->assertSuccessful();
});

it('allows users to create an asset', function () {
    $user = User::factory()->create();
    $user->assignRole(UserRole::ADMIN->value);
    actingAs($user);
    $category = Category::factory()->create();
    $location = Location::factory()->create();
    $vendor = Vendor::factory()->create();

    $assetData =[
        'name' => fake()->word,
        'description' => fake()->sentence,
        'category_id' => $category->id,
        'location_id' => $location->id,
        'vendor_id' => $vendor->id,
        'status' => AssetsStatus::in_use->value,
        'purchase_date' => now()->format('Y-m-d'),
        'item_type' => ItemType::PHYSICAL->value,
        'purchase_price' => fake()->randomFloat(2, 10, 1000),
        'warranty_information' => fake()->sentence,
        'depreciation_method' => DepreciationMethod::STRAIGHTLINE->value,
    ];
    
    livewire(CreateAsset::class)
        ->fillForm($assetData)
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('assets', $assetData);
});

it('allows users to edit an asset', function () {
    $user = User::factory()->create();
    $user->assignRole(UserRole::ADMIN->value);
    actingAs($user);
    $asset = Asset::factory()->create();

    $updated_Asset = [
        'name' => 'Updated Asset Name',
        'description' => 'Updated description',
    ];
    livewire(EditAsset::class, [
        'record' => $asset->id,
    ])
        ->fillForm($updated_Asset)
        ->call('save')
        ->assertHasNoFormErrors();

    assertDatabaseHas('assets', [
        'id' => $asset->id,
        'name' => 'Updated Asset Name',
        'description' => 'Updated description',
    ]);
});

it('allows users to view an asset', function () {
    $user = User::factory()->create();
    $user->assignRole(UserRole::ADMIN->value);
    actingAs($user);
    $asset = Asset::factory()->create();
    actingAs($user)->get('/admin/assets/' . $asset->id)->assertSuccessful();
});

it('allows users to delete an asset', function () {
    $user = User::factory()->create();
    $user->assignRole(UserRole::ADMIN->value);
    actingAs($user);
    $asset = Asset::factory()->create();
    livewire(EditAsset::class,
   [ 'record' => $asset->getRouteKey()]
    )
    ->callAction(DeleteAction::class);

    assertSoftDeleted('assets', ['id' => $asset->id]);
});






?>