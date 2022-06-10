<?php

namespace App\Models\Change;

use App\Models\BaseModel;
use App\Models\Change\Traits\Attributes\ChangeAttributes;
use App\Models\Change\Traits\Relations\ChangeRelationship;
use App\Models\Organization\Traits\Attributes\OrganizationAttributes;
use App\Models\Organization\Traits\Relations\OrganizationRelationships;
use App\Models\Traits\ModelAttributes;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 * @property mixed id
 * @property mixed name
 */
class Change extends BaseModel
{
    use ModelAttributes, ChangeAttributes, HasUserstamps, ChangeRelationship;

    protected $fillable = [
        'values',
        'status',
        'organization_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
