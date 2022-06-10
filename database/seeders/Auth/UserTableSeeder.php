<?php

namespace Database\Seeders\Auth;

use App\Enums\UserStatus;
use App\Models\Auth\User;
use Carbon\Carbon as Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate('users');

        //Add the master administrator, user id of 1
        $users = [
            [
                'name' => 'Alan',
                'email' => 'admin@admin.com',
                'password' => bcrypt('1234'),
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
                'status' => UserStatus::Active,
                'approved_at' => now(),

            ],
            [
                'name' => 'Justin',
                'email' => 'executive@executive.com',
                'password' => bcrypt('1234'),
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
                'status' => UserStatus::Active,
                'approved_at' => now(),

            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => bcrypt('1234'),
                'created_by' => 1,
                'updated_by' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
                'status' => UserStatus::Active,
                'approved_at' => now(),

            ],
        ];

        DB::table('users')->insert($users);

        $this->enableForeignKeys();
    }
}
