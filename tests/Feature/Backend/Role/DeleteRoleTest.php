<?php

namespace Tests\Feature\Backend\Role;

use Tests\TestCase;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Event;
use App\Events\Backend\Auth\Role\RoleDeleted;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_role_can_be_deleted()
    {
        $this->loginAsAdmin();

        $role = Role::factory()->create();

        $this->assertDatabaseHas('roles', ['id' => $role->id]);

        Event::fake([
            RoleDeleted::class,
        ]);

        $this->delete(route('admin.auth.role.destroy', $role));

        $this->assertSoftDeleted('roles', ['id' => $role->id]);
        Event::assertDispatched(RoleDeleted::class);
    }

    /**
     * @test
     */
    public function a_role_with_assigned_users_cant_be_deleted()
    {
        $this->loginAsAdmin();

        $role = Role::factory()->create();
        $user = User::factory()->create();
        $role->users()->attach($role->id);

        $response = $this->delete(route('admin.auth.role.destroy', $role));

        $response->assertSessionHas(['flash_danger' => __('exceptions.backend.access.roles.has_users')]);
    }

    /**
     * @test
     */
    public function admin_role_cant_be_deleted()
    {
        $role = Role::factory()->create(['id' => 1]);  //We consider 1 as administrator

        $this->loginAsAdmin();

        $response = $this->delete(route('admin.auth.role.destroy', $role));

        $response->assertSessionHas(['flash_danger' => __('exceptions.backend.access.roles.cant_delete_admin')]);
    }
}
