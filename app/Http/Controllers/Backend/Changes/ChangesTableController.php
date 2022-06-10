<?php

namespace App\Http\Controllers\Backend\Changes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Changes\ManageChangeRequest;
use App\Repositories\Backend\Change\ChangeRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class SensorsTableController.
 */
class ChangesTableController extends Controller
{
    public function __construct(private ChangeRepository $repository)
    {
    }

    public function __invoke(ManageChangeRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('created_by', function ($organization) {
                return $organization->user_name;
            })
            ->addColumn('created_at', function ($organization) {
                return $organization->created_at->toDateString();
            })
            ->addColumn('actions', function ($organization) {
                return $organization->action_buttons;
            })
            ->make(true);
    }
}
