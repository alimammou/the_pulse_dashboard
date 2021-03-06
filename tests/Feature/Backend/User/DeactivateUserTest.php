<?php

namespace Tests\Backend\User;

use Tests\TestCase;
use App\Enums\UserStatus;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Event;
use App\Events\Backend\Auth\User\UserDeactivated;
use App\Events\Backend\Auth\User\UserReactivated;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeactivateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_access_deactivated_users_page()
    {
        $this->loginAsAdmin();

        $response = $this->get(route('admin.auth.user.deactivated'))->assertStatus(200);
    }

    /** @test */
    public function an_admin_can_deactivate_users()
    {
        $user = User::factory()->create()->first();

        $this->loginAsAdmin();

        Event::fake([UserDeactivated::class]);

        $this->get(route('admin.auth.user.mark', ['user' => $user, 'status' => UserStatus::Inactive]))
            ->assertRedirect();

        $this->assertSame(UserStatus::Inactive()->value, $user->refresh()->status->value);
        Event::assertDispatched(UserDeactivated::class);
    }

    /** @test */
    public function an_admin_can_reactivate_users()
    {
        $user = User::factory()->states('inactive')->create();

        $this->loginAsAdmin();

        Event::fake();

        $this->get(route('admin.auth.user.mark', ['user' => $user, 'status' => 1]));

        $this->assertSame(true, $user->fresh()->status);
        Event::assertDispatched(UserReactivated::class);
    }

    /** @test */
    public function an_user_cant_deactivate_himself()
    {
        $admin = $this->loginAsAdmin();

        $response = $this->from(route('admin.auth.user.index'))->get(route('admin.auth.user.mark', ['user' => $admin, 'status' => 0]));

        $response->assertSessionHas(['flash_danger' => __('exceptions.backend.access.users.cant_deactivate_self')]);
        $response->assertRedirect(route('admin.auth.user.index'));
    }
}
