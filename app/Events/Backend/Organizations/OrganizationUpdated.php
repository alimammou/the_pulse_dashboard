<?php

namespace App\Events\Backend\Organizations;

use App\Models\Organization\Organization;
use Illuminate\Queue\SerializesModels;

/**
 * Class SensorUpdated.
 */
class OrganizationUpdated
{
    use SerializesModels;

    public function __construct(public Organization $organization)
    {
    }
}
