<?php
use App\Enums\UserRole;
use App\Filament\Resources\VendorResource;
use App\Models\User;
use App\Models\Vendor;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;
use function Pest\Laravel\assertSoftDeleted;


it('allows creating a vendor', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);

    livewire(VendorResource\Pages\CreateVendor::class)
        ->fillForm([
            'name' => 'Test Vendor',
            'contact_person' => 'John Doe',
            'phone_number' => '123-456-7890',
            'email' => 'test@example.com',
            'address' => '123 Test St',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    assertDatabaseHas('vendors', [
        'name' => 'Test Vendor',
        'contact_person' => 'John Doe',
        'phone_number' => '123-456-7890',
        'email' => 'test@example.com',
        'address' => '123 Test St',
    ]);
});

it('allows editing a vendor', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $vendor = Vendor::factory()->create();

    livewire(VendorResource\Pages\EditVendor::class, [
        'record' => $vendor->id,
    ])
        ->fillForm([
            'name' => 'Updated Vendor',
            'contact_person' => 'Jane Smith',
            'phone_number' => '987-654-3210',
            'email' => 'updated@example.com',
            'address' => '456 Updated St',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    assertDatabaseHas('vendors', [
        'id' => $vendor->id,
        'name' => 'Updated Vendor',
        'contact_person' => 'Jane Smith',
        'phone_number' => '987-654-3210',
        'email' => 'updated@example.com',
        'address' => '456 Updated St',
    ]);
});

it('allows deleting a vendor', function () {
    $user = User::factory()->withRole(UserRole::ADMIN->value)->create();
    actingAs($user);
    $vendor = Vendor::factory()->create();

    livewire(VendorResource\Pages\EditVendor::class,
        ['record' => $vendor->id])
        ->callAction(DeleteBulkAction::class)
        ->assertSuccessful();

    assertSoftDeleted('vendors', ['id' => $vendor->id]);
    
});


?>