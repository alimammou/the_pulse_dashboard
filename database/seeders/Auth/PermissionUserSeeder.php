<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;

/**
 * Class PermissionUserSeeder.
 */
class PermissionUserSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('permission_user');

        // Attach executive user permission
        $user = User::find(2);
        $permissions = $user->roles->first()->permissions->pluck('id');

        if (! empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user = User::find(3);
        $permissions = $user->roles->first()->permissions->pluck('id');

        if (! empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        $this->enableForeignKeys();
    }
}
