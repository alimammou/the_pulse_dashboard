<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Requests\Backend\Auth\User\CreateCsoUserRequest;
use App\Models\Auth\User;
use App\Http\Controllers\Controller;
use App\Http\Responses\ViewResponse;
use App\Models\Organization\Organization;
use Illuminate\Support\Facades\View;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;

class UserController extends Controller
{
    protected UserRepository $userRepository;

    protected RoleRepository $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        View::share('js', ['users']);
    }

    public function index(ManageUserRequest $request)
    {
        return new ViewResponse('backend.auth.user.index');
    }

    public function create(ManageUserRequest $request)
    {
        return view('backend.auth.user.create')
            ->withRoles($this->roleRepository->getAll());
    }
    public function createCso(ManageUserRequest $request)
    {
        return view('backend.auth.user.create-cso')
            ->withRoles($this->roleRepository->getAll());
    }

    public function store(StoreUserRequest $request)
    {
        $this->userRepository->create($request->validated());

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.access.users.created'));
    }
    public function storeCso(CreateCsoUserRequest $request)
    {
        $this->userRepository->createCso($request->validated());

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.access.users.created'));
    }
    public function show(ManageUserRequest $request, User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }
    public function approve(ManageUserRequest $request, User $user)
    {
        $user->approved_at=now();
        $user->save();

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.access.users.updated'));

    }
    public function edit(ManageUserRequest $request, User $user, PermissionRepository $permissionRepository)
    {
        return view('backend.auth.user.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->pluck('id')->all())
            ->withRoles($this->roleRepository->getAll())
            ->withPermissions($permissionRepository->getSelectData('display_name'))
            ->withUserPermissions($user->permissions->pluck('id')->all());
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($user, $request->validated());

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.access.users.updated'));
    }

    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->delete($user);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.access.users.deleted'));
    }
}
