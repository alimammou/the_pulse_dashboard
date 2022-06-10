<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Auth\Permission;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\WithFaker;
use App\Events\Backend\Auth\User\UserCreated;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Events\Backend\Auth\User\UserUpdated;
use App\Events\Backend\Auth\User\UserRestored;
use App\Events\Backend\Auth\User\UserDeactivated;
use App\Events\Backend\Auth\User\UserReactivated;
use App\Repositories\Backend\Auth\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Events\Backend\Auth\User\UserPasswordChanged;
use App\Events\Backend\Auth\User\UserPermanentlyDeleted;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var string role_id
     */
    protected $role_id;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->app->make(UserRepository::class);
    }

    protected function getValidUserData($userData = [])
    {
        return array_merge([
            'name' => 'John',
            'email' => 'john@example.com',
            'timezone' => 'UTC',
            'password' => 'secret',
            'assignees_roles' => [1],
        ], $userData);
    }

    /** @test */
    public function it_can_paginate_the_active_users()
    {
        User::factory()->count(30)->create();

        $paginatedUsers = $this->userRepository->getActivePaginated(25);

        $this->assertSame(2, $paginatedUsers->lastPage());
        $this->assertSame(25, $paginatedUsers->perPage());
        $this->assertSame(30, $paginatedUsers->total());

        $newPaginatedUsers = $this->userRepository->getActivePaginated(5);

        $this->assertSame(5, $newPaginatedUsers->perPage());
    }

    /** @test */
    public function it_can_paginate_the_inactive_users()
    {
        User::factory()->count(30)->create();
        User::factory()->count(25)->inactive()->create();

        $paginatedUsers = $this->userRepository->getInactivePaginated(10);

        $this->assertSame(3, $paginatedUsers->lastPage());
        $this->assertSame(10, $paginatedUsers->perPage());
        $this->assertSame(25, $paginatedUsers->total());
    }

    /** @test */
    public function it_can_paginate_the_soft_deleted_inactive_users()
    {
        User::factory()->count(30)->create();
        User::factory()->count(25)->softDeleted()->create();

        $paginatedUsers = $this->userRepository->getDeletedPaginated(10);

        $this->assertSame(3, $paginatedUsers->lastPage());
        $this->assertSame(10, $paginatedUsers->perPage());
        $this->assertSame(25, $paginatedUsers->total());
    }

    /** @test */
    public function it_can_create_new_users()
    {
        $this->actingAs(User::factory()->create()->first());

        $role = Role::factory()->create([
            'name' => 'Employee',
            'all' => 0,
            'status' => 1,
        ])->first();

        $permissions = Permission::factory()->count(3)->create([
            'status' => 1,
        ]);

        $userData = [
            'name' => $this->faker->firstName,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password(8),
            'status' => 1,
            'confirmed' => 1,
            'permissions' => $permissions->pluck('id', 'id')->toArray(),
            'assignees_roles' => [$role->id],
        ];

        Event::fake([
            UserCreated::class,
        ]);

        $user = $this->userRepository->create($userData);

        $this->assertSame(2, User::count());
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
            'status' => $userData['status'],
        ]);

        $this->assertTrue($user->hasRole($role->id));
        $this->assertSame($permissions->pluck('id', 'id')->toArray(), $user->permissions->pluck('id', 'id')->toArray());

        Event::assertDispatched(UserCreated::class, function (UserCreated $event) use ($userData) {
            return $event->user->name == $userData['name'] && $event->user->email == $userData['email'];
        });
    }

    /** @test */
    public function it_can_update_existing_users()
    {
        $this->actingAs(User::factory()->create()->first());

        // We need at least one role to create a user

        $role = Role::factory()->create([
            'name' => 'Employee',
            'all' => 0,
            'status' => 1,
        ])->first();

        $permissions = Permission::factory()->count(3)->create([
            'status' => 1,
        ]);

        $user = User::factory(1)->create([
            'name' => $this->faker->firstName,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password(8),
            'status' => 1,
        ])->first();

        $user->attachRoles([$role->id]);
        $user->attachPermissions($permissions->pluck('id', 'id')->toArray());

        Event::fake([
            UserUpdated::class,
        ]);

        // Now we'll try to update this user

        $newRole = Role::factory()->create([
            'name' => 'Staff',
            'all' => 0,
            'status' => 1,
        ]);

        $updateUserData = [
            'name' => $this->faker->firstName,
            'permissions' => Permission::factory(2)->create()->push($permissions->random(1))->flatten()->pluck('id', 'id')->sort()->toArray(),
            'assignees_roles' => [$newRole->id],
        ];

        $updatedUser = $this->userRepository->update($user, $updateUserData);

        $this->assertSame($updatedUser->name, $updateUserData['name']);
        $this->assertTrue($updatedUser->hasRole($newRole->id));
        $this->assertFalse($updatedUser->hasRole($role->id));
        $this->assertSame($updateUserData['permissions'], $updatedUser->permissions->pluck('id', 'id')->sort()->toArray());

        Event::assertDispatched(UserUpdated::class, function (UserUpdated $event) use ($updatedUser) {
            return $event->user->name == $updatedUser->name && $event->user->email == $updatedUser->email;
        });
    }

    /** @test */
    public function it_can_soft_delete_existing_users()
    {
        // We need at least one role to delete it.
        $user = User::factory()->create()->first();

        Event::fake([
            UserDeleted::class,
        ]);

        $this->userRepository->delete($user);

        $this->assertSame(1, User::onlyTrashed()->count());
        Event::assertDispatched(UserDeleted::class, 1);
    }

    /** @test */
    public function it_can_not_hard_delete_existing_users_which_is_not_soft_deleted_yet()
    {
        $this->expectException(GeneralException::class);

        // We need at least one role to change his status.
        $user = User::factory()->create()->first();

        $this->userRepository->forceDelete($user);
        // $this->assertTrue($this->userRepository->forceDelete($user));
    }

    /** @test */
    public function it_can_hard_delete_existing_users()
    {
        // We need at least one role to change his status.
        $user = User::factory()->create()->first();

        Event::fake([
            UserPermanentlyDeleted::class,
        ]);

        // Soft Delete User First
        $this->userRepository->delete($user);

        $this->assertTrue($this->userRepository->forceDelete($user));
        Event::assertDispatched(UserPermanentlyDeleted::class);
    }

    /** @test */
    public function it_can_restore_users_which_is_soft_deleted()
    {
        // We need at least one role to change his status.
        $user = User::factory()->create()->first();

        Event::fake([
            UserRestored::class,
        ]);

        // Soft Delete User First
        $this->userRepository->delete($user);

        $restoredUser = $this->userRepository->restore($user);
        $this->assertNull($restoredUser->deleted_at);
        Event::assertDispatched(UserRestored::class);
    }

    /** @test */
    public function it_can_not_restore_users_which_is_not_soft_deleted_yet()
    {
        $this->expectException(GeneralException::class);

        // We need at least one role to change his status.
        $user = User::factory()->create()->first();

        $restoredUser = $this->userRepository->restore($user);
    }

    /** @test */
    public function it_can_update_password_of_user()
    {
        $newPassword = '1234';
        $this->actingAs(User::factory()->create()->first());

        // We need at least one role to update his password.
        $user = User::factory()->create()->first();

        Event::fake([
            UserPasswordChanged::class,
        ]);

        $updatedUser = $this->userRepository->updatePassword($user, [
            'password' => $newPassword,
        ]);

        $this->assertTrue(Hash::check($newPassword, $updatedUser->password));
        Event::dispatched(UserPasswordChanged::class);
    }

    /** @test */
    public function it_can_change_status_of_user()
    {
        // We need at least one role to change his status.
        $user = User::factory()->create()->first();

        Event::fake([
            UserDeactivated::class,
            UserReactivated::class,
        ]);

        $activeUser = $this->userRepository->mark($user, 1);   //Mark Active
        $this->assertSame(true, $activeUser->status);

        Event::assertDispatched(UserReactivated::class);

        $activeUser = $this->userRepository->mark($user, 0);   //Mark Inactive
        $this->assertSame(false, $activeUser->status);

        Event::assertDispatched(UserDeactivated::class);
    }

    /**
     * @test
     */
    public function createUserStub_will_provide_user_stub()
    {
        $user = User::factory()->create()->first();
        $this->actingAs($user);

        $input = [
            'name' => $this->faker->firstName(),
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password(8),
        ];

        $result = $this->callPrivateMethod($this->userRepository, 'createUserStub', [$input]);

        $this->assertInstanceOf(User::class, $result);

        $this->assertSame($input['name'], $result->name);
        $this->assertSame($input['email'], $result->email);
        $this->assertSame(false, $result->status);

        $this->assertSame($user->id, $result->created_by);
        $this->assertTrue(Hash::check($input['password'], $result->password));
    }

    /**
     * @test
     */
    public function getForDataTable_will_provide_active_users_for_datatable()
    {
        $aciveUsers = User::factory()->count(6)->active()->create();
        $inactiveUsers = User::factory()->count(5)->inactive()->create();
        $activeDeletesUsers = User::factory()->count(4)->active()->softDeleted()->create();
        $inactiveDeletedUsers = User::factory()->count(3)->inactive()->softDeleted()->create();

        $this->assertCount($aciveUsers->count(), $this->userRepository->getForDataTable(1, false)->get()->toArray());
    }

    /**
     * @test
     */
    public function getForDataTable_will_provide_inactive_users_for_datatable()
    {
        $aciveUsers = User::factory()->count(6)->active()->create();
        $inactiveUsers = User::factory()->count(5)->inactive()->create();
        $activeDeletesUsers = User::factory()->count(4)->active()->softDeleted()->create();
        $inactiveDeletedUsers = User::factory()->count(3)->inactive()->softDeleted()->create();

        $this->assertCount($inactiveUsers->count(), $this->userRepository->getForDataTable(0, false)->get()->toArray());
    }

    /**
     * @test
     */
    public function getForDataTable_will_provide_deleted_users_for_datatable()
    {
        $aciveUsers = User::factory()->count(6)->active()->create();
        $inactiveUsers = User::factory()->count(5)->inactive()->create();
        $activeDeletesUsers = User::factory()->count(4)->active()->softDeleted()->create();
        $inactiveDeletedUsers = User::factory()->count(3)->inactive()->softDeleted()->create();

        $deletedUserCount = $activeDeletesUsers->count() + $inactiveDeletedUsers->count();

        $this->assertCount($deletedUserCount, $this->userRepository->getForDataTable(1, 'true')->get()->toArray());
        $this->assertCount($deletedUserCount, $this->userRepository->getForDataTable(0, 'true')->get()->toArray());
    }

    /**
     * @test
     */
    public function getForDataTable_will_provide_users_with_fields_for_datatable()
    {
        $aciveUsers = User::factory()->count(3)->active()->create();

        $result = $this->userRepository->getForDataTable(1)->get();

        $this->assertSame($aciveUsers->count(), $result->count());

        $result = $result->first()->toArray();

        $this->assertIsArray($result);

        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('email', $result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('confirmed', $result);
        $this->assertArrayHasKey('confirmed', $result);
        $this->assertArrayHasKey('created_at', $result);
        $this->assertArrayHasKey('updated_at', $result);
        $this->assertArrayHasKey('deleted_at', $result);
        $this->assertArrayHasKey('full_name', $result);
    }
}
