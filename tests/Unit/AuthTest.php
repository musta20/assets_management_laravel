<?php

use App\Enums\UserRole;
use App\Models\User;
use Database\Seeders\TestSeeder;

it(
    'profile page is displayed',
    function () {

    $user = User::factory()->create();
        
        $user->assignRole(UserRole::ADMIN->value);

        $this->actingAs($user);

        $response = $this->get('/admin/assets');

        $response->assertSuccessful();

    }


);
