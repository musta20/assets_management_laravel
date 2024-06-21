<?php

namespace Tests;

use Database\Seeders\PermissionSeeder;
use Database\Seeders\TestSeeder;
use Illuminate\Database\Events\DatabaseRefreshed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Event;
use Spatie\Permission\PermissionRegistrar;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {

        parent::setUp();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->seed(PermissionSeeder::class);

        $this->artisan('permissions:sync');

        //  (new TestSeeder())->run();

        // $this->app->make(PermissionRegistrar::class)->registerPermissions();
        //app()[\Spatie\Permission\PermissionRegistrar::class]->registerPermissions(befor);

        // Event::listen(DatabaseRefreshed::class, function () {
        //     echo('database refreshed');
        //     (new TestSeeder())->run();
        //     $this->artisan('permissions:sync');
        //     // $this->artisan('db:seed', ['--class' => RoleAndPermissionSeeder::class]);
        // });

        // $this->user = User::factory()->create();
        // $this->user->assignRole(UserRole::Admin->value);
        // $this->actingAs($this->user);

        //$this->app->make(PermissionRegistrar::class)->registerPermissions();

    }
}
