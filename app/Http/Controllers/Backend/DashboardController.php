<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ViewBackendRequest;
use App\Models\Auth\Role;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Auth\Permission;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{

    public function index(ViewBackendRequest $request)
    {
        return redirect()->route('admin.organizations.index');
    }

    public function getPermissionByRole(Request $request)
    {
        if ($request->ajax()) {
            $role_id = $request->get('role_id');
            $rsRolePermissions = Role::where('id', $role_id)->first();
            $rolePermissions = $rsRolePermissions->permissions->pluck('display_name', 'id')->all();
            $permissions = Permission::pluck('display_name', 'id')->all();
            ksort($rolePermissions);
            ksort($permissions);
            $results['permissions'] = $permissions;
            $results['rolePermissions'] = $rolePermissions;
            $results['allPermissions'] = $rsRolePermissions->all;
            echo json_encode($results);
            exit;
        }
    }
}
