<?php

namespace Tests\Feature\Backend\User;

use Tests\TestCase;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Auth\Permission;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use App\Events\Backend\Auth\User\UserCreated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_create_user_page()
    {
        $this->loginAsAdmin();

        $response = $this->get(route('admin.auth.user.create'));

        $response->assertStatus(200);
        $response->assertViewIs('backend.auth.user.create');
    }

    /** @test */
    public function create_user_has_required_fields()
    {
        $this->loginAsAdmin();

        $response = $this->post(route('admin.auth.user.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'password', 'assignees_roles', 'permissions']);
    }

    /** @test */
    public function user_email_needs_to_be_unique()
    {
        $this->loginAsAdmin();
        User::factory()->create(['email' => 'john@example.com']);
        $role = Role::factory()->create();
        $permissions = Permission::factory()->count(3)->create();

        $response = $this->post(route('admin.auth.user.store'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'active' => '1',
            'confirmed' => '0',
            'timezone' => 'UTC',
            'confirmation_email' => '1',
            'assignees_roles' => [$role->id],
            'permissions' => $permissions->pluck('id')->toArray(),
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertSame(1, User::where('email', 'john@example.com')->count());
    }

    /** @test */
    public function admin_can_create_new_user()
    {
        $this->loginAsAdmin();

        $role = Role::factory()->create()->first();
        $permissions = Permission::factory()->count(3)->create();

        Event::fake(UserCreated::class);

        $response = $this->post(route('admin.auth.user.store'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
            'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            'timezone' => 'UTC',
            'confirmation_email' => '1',
            'assignees_roles' => [$role->id],
            'permissions' => $permissions->pluck('id')->toArray(),
        ]);

        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.created')]);

        $user = User::where([
            'name' => 'John',
            'email' => 'john@example.com',
        ])->first();

        $this->assertSame('John', $user->name);
        $this->assertSame('john@example.com', $user->email);
        $this->assertSame($role->id, $user->roles->first()->id);

        Event::assertDispatched(UserCreated::class);
    }

    /** @test */
    public function when_an_unconfirmed_user_is_created_a_notification_will_be_sent()
    {
        $this->markTestIncomplete("Notification gets logged in file. Maybe thatswhy assertSentTo don't work.");

        $this->loginAsAdmin();

        $role = Role::factory()->create();
        $permissions = Permission::factory()->count(3)->create();

        Notification::fake();

        $response = $this->post(route('admin.auth.user.store'), [
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'OC4Nzu270N!QBVi%U%qX',
            'password_confirmation' => 'OC4Nzu270N!QBVi%U%qX',
            'active' => '1',
            'confirmed' => '0',
            'timezone' => 'UTC',
            'confirmation_email' => '1',
            'assignees_roles' => [$role->id],
            'permissions' => $permissions->pluck('id')->toArray(),
        ]);

        $response->assertSessionHas(['flash_success' => __('alerts.backend.access.users.created')]);

        $user = User::where('email', 'john@example.com')->first();

        Notification::assertSentTo([$user], UserNeedsConfirmation::class);
    }
}
