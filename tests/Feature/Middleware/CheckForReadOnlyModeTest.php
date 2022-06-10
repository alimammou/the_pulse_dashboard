<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckForReadOnlyModeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_not_alter_data_if_read_only_mode_is_enabled()
    {
        config(['app.read_only' => true]);
        $role = Role::factory()->create();

        $this->loginAsAdmin();

        $response = $this->delete("/admin/auth/role/{$role->id}");

        $this->assertSame($response->getStatusCode(), Response::HTTP_UNAUTHORIZED);
        $this->assertDatabaseHas(config('permission.table_names.roles'), ['id' => $role->id]);
    }

    /** @test */
    public function a_user_can_alter_data_if_read_only_mode_is_disabled()
    {
        config(['app.read_only' => false]);
        $role = Role::factory()->create([
            'id' => 123,
        ]);

        $this->loginAsAdmin();

        $this->followingRedirects()
            ->delete("/admin/auth/role/{$role->id}")
            ->assertOk();

        $this->assertSoftDeleted(config('permission.table_names.roles'), ['id' => $role->id]);
    }

    /** @test */
    public function a_user_can_login_if_read_only_mode_is_enabled()
    {
        config(['app.read_only' => true]);

        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $this->post('/login', [
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $this->assertAuthenticatedAs($user);
    }
}
