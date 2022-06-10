<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Auth\User;
use Laravel\Sanctum\Sanctum;
use Laravel\Passport\Passport;
use Database\Seeders\Auth\RoleTableSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BaseApiTestCase extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleTableSeeder::class);
        $user = User::factory()->count(1)->create()->first();
        // Attach administrative roles
        $user->attachRole(1);
        Passport::actingAs($user);
        Sanctum::actingAs($user);
    }
}
