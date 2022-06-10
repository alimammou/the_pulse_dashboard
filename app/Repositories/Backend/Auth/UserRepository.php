<?php

namespace App\Repositories\Backend\Auth;

use App\Models\CsoUser;
use Exception;
use Throwable;
use App\Enums\UserStatus;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Events\Backend\Auth\User\UserCreated;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Events\Backend\Auth\User\UserUpdated;
use App\Events\Backend\Auth\User\UserRestored;
use App\Events\Backend\Auth\User\UserConfirmed;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Events\Backend\Auth\User\UserDeactivated;
use App\Events\Backend\Auth\User\UserReactivated;
use App\Events\Backend\Auth\User\UserUnconfirmed;
use App\Events\Backend\Auth\User\UserPasswordChanged;
use App\Notifications\Backend\Auth\UserAccountActive;
use App\Events\Backend\Auth\User\UserPermanentlyDeleted;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

    public function getForDataTable(string $status = UserStatus::Active, bool $trashed = false)
    {
        /**
         * Note: You must return deleted_at or the User getActionButtonsAttribute won't
         * be able to differentiate what buttons to show for each row.
         */
        $dataTableQuery = $this->query()
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'users.deleted_at',
                'users.approved_at'
            ]);

        if ($trashed == true) {
            return $dataTableQuery->onlyTrashed();
        }

        return $dataTableQuery->active($status);
    }

    /**
     * @param array $data
     *
     * @throws Throwable
     * @throws Exception
     * @return User
     */
    public function create(array $data)
    {
        $roles = $data['assignees_roles'];
        $permissions = $data['permissions'];

        unset($data['assignees_roles']);
        unset($data['permissions']);

        $user = $this->createUserStub($data);

        return DB::transaction(function () use ($user, $data, $roles, $permissions) {
            if ($user->save()) {
                //Attach new roles
                $user->attachRoles($roles);

                // Attach New Permissions
                $user->attachPermissions($permissions);

                event(new UserCreated($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.create_error'));
        });
    }
    public function createCso(array $data)
    {

        $user = $this->createUserStub($data);

        return DB::transaction(function () use ($user, $data) {
            if ($user->save()) {
                  CsoUser::create([
                      'user_id'=>$user->id,
                      'organization_id'=>$data['cso']
                  ]);
                event(new UserCreated($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.create_error'));
        });
    }
    /**
     * @param  $input
     *
     * @return mixed
     */
    protected function createUserStub($input)
    {
        $user = self::MODEL;
        $user = new $user();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->approved_at = now();
        $user->password = bcrypt($input['password']);
        $user->status = $input['status'] ?? UserStatus::Inactive;
        $user->created_by = access()->user()->id;

        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     *
     * @throws Exception
     * @throws Throwable
     * @return User
     */
    public function update(User $user, array $data): User
    {
        if ($user->is_root) {
            $data['assignees_roles'] = [1];
            $data['status'] = UserStatus::Active;
        }

        $roles = $data['assignees_roles'];
        $permissions = $data['permissions'] ?? [];

        unset($data['assignees_roles']);
        unset($data['permissions']);

        return DB::transaction(function () use ($user, $data, $roles, $permissions) {
            $user->status = $data['status'] ?? UserStatus::Inactive;

            if ($user->update($data)) {
                $user->roles()->sync($roles);
                $user->permissions()->sync($permissions);

                event(new UserUpdated($user));

                return $user;
            }

            throw new GeneralException(__('exceptions.backend.access.users.update_error'));
        });
    }

    public function delete(User $user): bool
    {
        if (access()->id() == $user->id) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_delete_self'));
        }

        if ($user->delete()) {
            event(new UserDeleted($user));

            return true;
        }

        throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
    }

    /**
     * @param User $user
     * @param      $input
     *
     * @throws GeneralException
     * @return User
     */
    public function updatePassword(User $user, $input): User
    {
        if ($user->update(['password' => bcrypt($input['password'])])) {
            event(new UserPasswordChanged($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param User $user
     * @param string $status
     *
     * @throws GeneralException
     * @return User
     */
    public function mark(User $user, string $status): User
    {
        if (access()->id() == $user->id && $status == UserStatus::Inactive) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user->status = $status;

        switch ($status) {
            case UserStatus::Inactive():
                event(new UserDeactivated($user));
                break;
            case UserStatus::Active():
                event(new UserReactivated($user));
                break;
        }

        if ($user->save()) {
            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.mark_error'));
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function confirm(User $user): User
    {
        if ($user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.already_confirmed'));
        }

        $user->confirmed = true;
        $confirmed = $user->save();

        if ($confirmed) {
            event(new UserConfirmed($user));

            // Let user know their account was approved
            if (config('access.users.requires_approval')) {
                $user->notify(new UserAccountActive);
            }

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_confirm'));
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function unconfirm(User $user): User
    {
        if (! $user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.not_confirmed'));
        }

        if ($user->id === 1) {
            // Cant un-confirm admin
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_admin'));
        }

        if ($user->id === auth()->id()) {
            // Cant un-confirm self
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_self'));
        }

        $user->confirmed = false;
        $unconfirmed = $user->save();

        if ($unconfirmed) {
            event(new UserUnconfirmed($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm'));
    }

    /**
     * @param User $user
     *
     * @throws Exception
     * @throws Throwable
     * @throws GeneralException
     * @return User
     */
    public function forceDelete(User $user)
    {
        if ($user->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }

        return DB::transaction(function () use ($user) {
            // Delete associated relationships
            $user->passwordHistories()->delete();
            $user->providers()->delete();

            if ($user->forceDelete()) {
                event(new UserPermanentlyDeleted($user));

                return true;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function restore(User $user): User
    {
        if ($user->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_restore'));
        }

        if ($user->restore()) {
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->query()
            ->with('roles', 'permissions', 'providers')
            ->active()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->query()
            ->with('roles', 'permissions', 'providers')
            ->active(false)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc'): LengthAwarePaginator
    {
        return $this->query()
            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    public function getAutoCompletePaginated(mixed $param)
    {
        return $this->query()
            ->where('status', UserStatus::Active)
            ->when($param, fn ($q) => $q->where('email', 'LIKE', '%'.$param.'%'))
            ->select('email', 'id')
            ->paginate(10);
    }

    /**
     * @param  $roles
     *
     * @throws GeneralException
     */
    protected function checkUserRolesCount($roles)
    {
        //User Updated, Update Roles
        //Validate that there's at least one role chosen
        if (count($roles) == 0) {
            throw new GeneralException(__('exceptions.backend.access.users.role_needed'));
        }
    }
}
