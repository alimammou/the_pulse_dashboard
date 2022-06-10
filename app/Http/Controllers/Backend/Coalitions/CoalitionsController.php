<?php

namespace App\Http\Controllers\Backend\Coalitions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Coalitions\ManageCoalitionRequest;
use App\Http\Requests\Backend\Coalitions\StoreCoalitionRequest;
use App\Http\Requests\Backend\Coalitions\UpdateCoalitionRequest;
use App\Http\Requests\Backend\Coalitions\DeleteCoalitionRequest;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Coalition\Coalition;
use App\Repositories\Backend\Coalition\CoalitionRepository;
use Illuminate\Contracts\View\View;

class CoalitionsController extends Controller
{
    public function __construct(private CoalitionRepository $repository)
    {
    }

    public function index(ManageCoalitionRequest $request)
    {
        return new ViewResponse('backend.coalitions.index');
    }

    public function create(ManageCoalitionRequest $request, Coalition $coalition): View
    {
        return view('backend.coalitions.create');
    }

    public function store(StoreCoalitionRequest $request)
    {
        $this->repository->create($request->validated());

        return RedirectResponse::new(route('admin.coalitions.index'), ['flash_success' => __('alerts.backend.coalitions.created')]);
    }

    public function edit(Coalition $coalition, ManageCoalitionRequest $request): View
    {
        return view('backend.coalitions.edit', compact('coalition'));
    }

    public function update(Coalition $coalition, UpdateCoalitionRequest $request)
    {
        $this->repository->update($coalition, $request->validated());

        return new RedirectResponse(route('admin.coalitions.index'), ['flash_success' => __('alerts.backend.coalitions.updated')]);
    }

    public function destroy(Coalition $coalition, DeleteCoalitionRequest $request)
    {
        $this->repository->delete($coalition);

        return new RedirectResponse(route('admin.coalitions.index'), ['flash_success' => __('alerts.backend.coalitions.deleted')]);
    }

}
