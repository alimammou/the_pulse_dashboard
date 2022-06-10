<?php

namespace Database\Seeders\Auth;

use Carbon\Carbon;
use App\Models\Auth\Permission;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;

/**
 * Class PermissionTableSeeder.
 */
class PermissionTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    private int $sort = 0;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncateMultiple(['permissions', 'permission_role']);

        /*
         * Don't need to assign any permissions to administrator because the all flag is set to true
         * in RoleTableSeeder.php.
         */

        // Misc Access Permissions.
        $this->create(
            name: 'view-access-management',
            display_name: 'View Access Management',
        );

        $this->create(
            name: 'view-logs',
            display_name: 'View Log Management',
        );
        $this->create(
            name: 'view-backend',
            display_name: 'View Backend',
        );

        $this->create(
            name: 'view-user-management',
            display_name: 'View User Management',
        );

        $this->create(
            name: 'view-active-user',
            display_name: 'View Active User',
        );

        $this->create(
            name: 'view-deactive-user',
            display_name: 'View Deactive User',
        );

        $this->create(
            name: 'view-deleted-user',
            display_name: 'View Deleted User',
        );

        $this->create(
            name: 'show-user',
            display_name: 'Show User Details',
        );

        $this->create(
            name: 'create-user',
            display_name: 'Create User',
        );

        $this->create(
            name: 'edit-user',
            display_name: 'Edit User',
        );

        $this->create(
            name: 'delete-user',
            display_name: 'Delete User',
        );

        $this->create(
            name: 'activate-user',
            display_name: 'Activate User',
        );

        $this->create(
            name: 'deactivate-user',
            display_name: 'Deactivate User',
        );

        $this->create(
            name: 'login-as-user',
            display_name: 'Login As User',
        );

        $this->create(
            name: 'clear-user-session',
            display_name: 'Clear User Session',
        );

        // Role Management.
        $this->create(
            name: 'view-role-management',
            display_name: 'View Role Management',
        );

        $this->create(
            name: 'create-role',
            display_name: 'Create Role',
        );

        $this->create(
            name: 'edit-role',
            display_name: 'Edit Role',
        );

        $this->create(
            name: 'delete-role',
            display_name: 'Delete Role',
        );

        // Permission Management.
        $this->create(
            name: 'view-permission-management',
            display_name: 'View Permission Management',
        );

        $this->create(
            name: 'create-permission',
            display_name: 'Create Permission',
        );

        $this->create(
            name: 'edit-permission',
            display_name: 'Edit Permission',
        );

        $this->create(
            name: 'delete-permission',
            display_name: 'Delete Permission',
        );

        // Settings.
        $this->create(
            name: 'edit-settings',
            display_name: 'Edit Settings',
        );

        $this->enableForeignKeys();
    }

    private function create(string $name, string $display_name)
    {
        $permission = new Permission();
        $permission->name = $name;
        $permission->display_name = $display_name;
        $permission->sort = $this->nextSort();
        $permission->created_by = 1;
        $permission->updated_by = null;
        $permission->created_at = Carbon::now();
        $permission->updated_at = Carbon::now();
        $permission->deleted_at = null;
        $permission->save();
    }

    private function nextSort()
    {
        ++$this->sort;

        return $this->sort;
    }
}
