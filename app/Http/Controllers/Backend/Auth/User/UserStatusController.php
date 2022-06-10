<?php

namespace App\Http\Controllers\Backend\Auth\User;

use Throwable;
use App\Enums\UserStatus;
use App\Models\Auth\User;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\MarkUserRequest;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;

/**
 * Class UserStatusController.
 */
class UserStatusController extends Controller
{
    protected UserRepository $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        View::share('js', ['users']);
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageUserRequest $request)
    {
        return view('backend.auth.user.deactivated')
            ->withUsers($this->repository->getInactivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageUserRequest $request)
    {
        return view('backend.auth.user.deleted');
    }

    /**
     * @param ManageUserRequest $request
     * @param User $user
     * @param string $status
     *
     * @throws GeneralException
     * @return mixed
     */
    public function mark(MarkUserRequest $request, User $user, string $status)
    {
        $this->repository->mark($user, $status);

        return redirect()->route(
            $status === UserStatus::Active ?
                'admin.auth.user.index' :
                'admin.auth.user.deactivated'
        )->withFlashSuccess(__('alerts.backend.access.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User $deletedUser
     *
     * @throws Throwable
     * @throws GeneralException
     * @return mixed
     */
    public function delete(ManageUserRequest $request, User $deletedUser)
    {
        $this->repository->forceDelete($deletedUser);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.access.users.deleted_permanently'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User $deletedUser
     *
     * @throws GeneralException
     * @return mixed
     */
    public function restore(ManageUserRequest $request, User $deletedUser)
    {
        $this->repository->restore($deletedUser);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.access.users.restored'));
    }
}
