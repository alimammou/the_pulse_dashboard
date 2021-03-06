<?php

namespace Database\Seeders\Auth;

use App\Models\Auth\User;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('role_user');

        //Attach admin role to admin user
        User::first()->attachRole(1);

        //Attach executive role to executive user
        User::find(2)->attachRole(2);

        //Attach user role to general user
        User::find(3)->attachRole(3);

        $this->enableForeignKeys();
    }
}
