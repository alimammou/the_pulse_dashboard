<?php

namespace App\Events\Backend\Auth\Permission;

use App\Models\Auth\Permission;
use Illuminate\Queue\SerializesModels;

/**
 * Class PermissionCreated.
 */
class PermissionCreated
{
    use SerializesModels;

    public function __construct(public Permission $permission)
    {
    }
}
