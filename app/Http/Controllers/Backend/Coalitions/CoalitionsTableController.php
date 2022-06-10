<?php

namespace App\Http\Controllers\Backend\Coalitions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Coalitions\ManageCoalitionRequest;
use App\Repositories\Backend\Coalition\CoalitionRepository;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class SensorsTableController.
 */
class CoalitionsTableController extends Controller
{
    public function __construct(private CoalitionRepository $repository)
    {
    }

    public function __invoke(ManageCoalitionRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('status', function ($coalition) {
                return $coalition->status;
            })
            ->addColumn('created_by', function ($coalition) {
                return $coalition->user_name;
            })
            ->addColumn('created_at', function ($coalition) {
                return $coalition->created_at->toDateString();
            })
            ->addColumn('actions', function ($coalition) {
                return $coalition->action_buttons;
            })
            ->make(true);
    }
}
