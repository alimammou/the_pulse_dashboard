<?php

namespace App\Http\Controllers\Backend\Auth\User;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Backend\Auth\UserRepository;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;

/**
 * Class UserTableController.
 */
class UserTableController extends Controller
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ManageUserRequest $request)
    {
        return Datatables::make($this->repository->getForDataTable($request->get('status'), (bool) $request->get('trashed')))
            ->escapeColumns(['name', 'email'])
            ->addColumn('roles', function ($user) {
                return $user->roles_label;
            })
            ->addColumn('status', function ($user) {
                return $user->status->value;
            })
            ->addColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->toDateString();
            })
            ->addColumn('approved_at', function ($user) {
                if($user->approved_at)
                return 'Yes';
                else
                    return 'No';
            })
            ->addColumn('updated_at', function ($user) {
                return Carbon::parse($user->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($user) {
                return $user->action_buttons;
            })
            ->make(true);
    }
}
