<?php

namespace App\Http\Controllers\Backend\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Organizations\ManageOrganizationRequest;
use App\Repositories\Backend\Organization\OrganizationRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class SensorsTableController.
 */
class OrganizationsTableController extends Controller
{
    public function __construct(private OrganizationRepository $repository)
    {
    }

    public function __invoke(ManageOrganizationRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($organization) {
                return $organization->status;
            })
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
