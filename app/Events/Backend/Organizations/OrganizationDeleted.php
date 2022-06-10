<?php

namespace App\Events\Backend\Organizations;

use App\Models\Organization\Organization;
use Illuminate\Queue\SerializesModels;

/**
 * Class SensorDeleted.
 */
class OrganizationDeleted
{
    use SerializesModels;

    public function __construct(public Organization $organization)
    {
    }
}
