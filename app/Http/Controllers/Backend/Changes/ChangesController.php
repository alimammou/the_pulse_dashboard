<?php

namespace App\Http\Controllers\Backend\Changes;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Organizations\ManageOrganizationRequest;
use App\Http\Requests\Backend\Organizations\StoreOrganizationRequest;
use App\Http\Requests\Backend\Organizations\UpdateOrganizationRequest;
use App\Http\Requests\Backend\Organizations\DeleteOrganizationRequest;
use App\Http\Responses\RedirectResponse;
use App\Http\Responses\ViewResponse;
use App\Models\Change\Change;
use App\Repositories\Backend\Organization\OrganizationRepository;
use Illuminate\Contracts\View\View;

class ChangesController extends Controller
{
    public function __construct(private OrganizationRepository $repository)
    {
    }

    public function index(ManageOrganizationRequest $request)
    {
        return new ViewResponse('backend.Notifications.index');
    }

    public function edit(Change $notification, ManageOrganizationRequest $request): View
    {
        return view('backend.Notifications.edit', compact('notification'));
    }
    public function approve(Change $notification, ManageOrganizationRequest $request): View
    {

    }
    public function reject(Change $notification, ManageOrganizationRequest $request): View
    {

    }
}
