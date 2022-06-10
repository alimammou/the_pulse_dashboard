<?php

namespace Tests\Feature\Backend\Role;

use Tests\TestCase;
use App\Models\Auth\Role;
use App\Models\Auth\Permission;
use Illuminate\Support\Facades\Event;
use App\Events\Backend\Auth\Role\RoleUpdated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_edit_role_page()
    {
        $role = Role::factory()->create();
        $this->loginAsAdmin();

        $this->get(route('admin.auth.role.edit', $role))->assertStatus(200);
    }

    /** @test */
    public function name_is_required()
    {
        $role = Role::factory()->create()->first();
        $this->loginAsAdmin();

        $response = $this->patch(route('admin.auth.role.update', $role), ['name' => '']);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function the_name_must_be_unique()
    {
        $oldRole = Role::factory()->create(['name' => 'First Role']);
        $role = Role::factory()->create(['name' => 'Second Role']);

        $this->loginAsAdmin();

        $permission = Permission::factory()->create();

        $roleData = [
            'name' => $oldRole->name,
            'associated_permissions' => 'custom',
            'permissions' => [$permission->id],
        ];

        $response = $this->patch(route('admin.auth.role.update', $role), $roleData);
        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function at_least_one_permission_is_required()
    {
        $role = Role::factory()->create();
        $this->loginAsAdmin();

        $response = $this->patch(route('admin.auth.role.update', $role), ['name' => 'new role']);
        $response->assertSessionHasErrors('permissions');
    }

    /**
     * @test
     */
    public function a_role_name_can_be_updated()
    {
        $role = Role::factory()->create(['id' => 2]);  //Changed Id because we are considering 1 as id of admin role.

        $this->loginAsAdmin();

        $permission = Permission::factory()->create();

        $roleData = [
            'name' => 'new role',
            'associated_permissions' => 'custom',
            'permissions' => [$permission->id],
        ];

        Event::fake([
            RoleUpdated::class,
        ]);

        $this->patch(route('admin.auth.role.update', $role), $roleData);

        $role->refresh();
        $this->assertSame($roleData['name'], $role->name);
        $this->assertSame($permission->id, $role->permissions()->first()->id);

        Event::assertDispatched(RoleUpdated::class);
    }
}
