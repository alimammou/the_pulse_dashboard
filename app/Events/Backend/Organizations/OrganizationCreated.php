<?php

namespace App\Events\Backend\Organizations;

use App\Models\Organization\Organization;
use Illuminate\Queue\SerializesModels;

class OrganizationCreated
{
    use SerializesModels;

    public function __construct(public Organization $organization)
    {
    }
}
