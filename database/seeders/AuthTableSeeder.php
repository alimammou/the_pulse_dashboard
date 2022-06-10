<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Auth\RoleTableSeeder;
use Database\Seeders\Auth\UserTableSeeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Auth\UserRoleTableSeeder;
use Database\Seeders\Auth\PermissionRoleSeeder;
use Database\Seeders\Auth\PermissionUserSeeder;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Auth\PermissionTableSeeder;

/**
 * Class AuthTableSeeder.
 */
class AuthTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncateMultiple([
            'password_histories',
            'password_resets',
            'social_accounts',
        ]);

        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(PermissionUserSeeder::class);

        $this->enableForeignKeys();
    }
}
