<?php

namespace Tests\Feature\Backend\User;

use Tests\TestCase;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Auth\Permission;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use App\Events\Backend\Auth\User\UserUpdated;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_the_edit_user_page()
    {
        $this->loginAsAdmin();
        $user = User::factory()->create();

        $response = $this->get(route('admin.auth.user.edit', $user));

        $response->assertStatus(200);
    }

    /** @test  */
    public function an_admin_can_resend_users_confirmation_email()
    {
        $this->markTestIncomplete('See here notification working, but not logging.');

        $this->loginAsAdmin();
        $user = User::factory()->states('unconfirmed')->create();

        Notification::fake();

        $this->get(route('admin.auth.user.account.confirm.resend', $user));

        Notification::assertSentTo($user, UserNeedsConfirmation::class);
    }

    /** @test */
    public function a_user_can_be_updated()
    {
        $this->loginAsAdmin();
        $user = User::factory()->create();
        $role = Role::factory()->create();
        $permissions = Permission::factory()->count(3)->create();

        Event::fake();

        $this->assertNotSame('John', $user->name);
        $this->assertNotSame('john@example.com', $user->email);

        $this->patch(route('admin.auth.user.update', $user), [
            'name' => 'John',
            'email' => 'john@example.com',
            'assignees_roles' => [$role->id],
            'permissions' => $permissions->pluck('id')->toArray(),
        ]);

        $user = $user->refresh();

        $this->assertSame('John', $user->name);
        $this->assertSame('john@example.com', $user->email);

        Event::assertDispatched(UserUpdated::class);
    }
}
