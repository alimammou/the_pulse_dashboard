<?php

namespace App\Http\Controllers\Backend\Organizations;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Organizations\ManageOrganizationRequest;
use App\Http\Requests\Backend\Organizations\StoreOrganizationRequest;
use App\Http\Requests\Backend\Organizations\UpdateOrganizationRequest;
use App\Http\Requests\Backend\Organizations\DeleteOrganizationRequest;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Coalition\Coalition;
use App\Models\Organization\Organization;
use App\Models\OrganizationCoalition\OrganizationCoalition;
use App\Repositories\Backend\Organization\OrganizationRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;


class OrganizationsController extends Controller
{
    public function __construct(private OrganizationRepository $repository)
    {
    }

    public function index(ManageOrganizationRequest $request)
    {
        return new ViewResponse('backend.organizations.index');
    }

    public function create(ManageOrganizationRequest $request, Organization $organization): View
    {
        return view('backend.organizations.create');
    }

    public function store(StoreOrganizationRequest $request)
    {
        $this->repository->create($request->validated());

        return RedirectResponse::new(route('admin.organizations.index'), ['flash_success' => __('alerts.backend.organizations.created')]);
    }

    public function edit(Organization $organization, ManageOrganizationRequest $request): View
    {
        return view('backend.organizations.edit', compact('organization'));
    }

    public function update(Organization $organization, UpdateOrganizationRequest $request)
    {
        $this->repository->update($organization, $request->validated());

        return new RedirectResponse(route('admin.organizations.index'), ['flash_success' => __('alerts.backend.organizations.updated')]);
    }

    public function destroy(Organization $organization, DeleteOrganizationRequest $request)
    {
        $this->repository->delete($organization);

        return new RedirectResponse(route('admin.organizations.index'), ['flash_success' => __('alerts.backend.organizations.deleted')]);
    }
    public function coalitions($id,ManageOrganizationRequest $request)
    {
      $organization=Organization::find($id);
        $data=OrganizationCoalition::where('organization_id',$id)->get();
        $coalitions=Coalition::all();
        return view('backend.organizations.show', compact('organization','data','coalitions'));

    }
    public function addCoalition($id, Request $request)
    {
        $org=OrganizationCoalition::where('organization_id',$id)->where('coalition_id',$request->coalition_id)->first();
        if($org)
        {
            return new RedirectResponse(route('admin.organizations.get-coalitions',$id), ['flash_warning' => __('organization already added to coalition')]);

        }
        $c=OrganizationCoalition::create([
            'organization_id'=>$id,
            'coalition_id'=> $request->coalition_id
        ]);
        return new RedirectResponse(route('admin.organizations.get-coalitions',$id), ['flash_success' => __('organization  added to coalition successfully')]);

    }
    public function deleteConnection($id,ManageOrganizationRequest $request)
    {
        $connection=OrganizationCoalition::where('id',$id)->first();
        $idd=$connection->organization_id;
        $connection->delete();
        return new RedirectResponse(route('admin.organizations.get-coalitions',$idd), ['flash_success' => __('Successfully Deleted')]);

    }
}
