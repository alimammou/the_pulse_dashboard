<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Event;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_login_route_exists()
    {
        $this->get(route('login'))->assertStatus(200);
    }

    /** @test */
    public function a_user_can_login_with_email_and_password()
    {
        $user = User::factory()->create([
            'email' => 'john@example.com',
            'password' => 'secret',
        ])->first();

        Event::fake();

        $this->post(route('login'), [
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

//        Event::assertDispatched(UserLoggedIn::class);
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function inactive_users_cant_login()
    {
        $user = User::factory()->inactive()->create([
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response = $this->post(route('login'), [
            'email' => 'john@example.com',
            'password' => 'secret',
        ]);

        $response->assertSessionHas('flash_danger');
        $this->assertFalse($this->isAuthenticated());
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->post(route('login'), [
            'email' => '',
            'password' => '12345',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        $response = $this->post(route('login'), [
            'email' => 'john@example.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function cant_login_with_invalid_credentials()
    {
        $this->withoutExceptionHandling();

        $this->expectException(ValidationException::class);

        $this->post(route('login'), [
            'email' => 'not-existend@user.com',
            'password' => '9s8gy8s9diguh4iev',
        ]);
    }

    /** @test */
    public function a_user_can_log_out()
    {
        $user = User::factory()->create()->first();
        Event::fake();

        $this->actingAs($user)
            ->get('/logout')
            ->assertRedirect('/');

        $this->assertFalse($this->isAuthenticated());
        Event::assertDispatched(UserLoggedOut::class);
    }
}
