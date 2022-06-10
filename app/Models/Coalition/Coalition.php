<?php

namespace App\Models\Coalition;

use App\Models\BaseModel;
use App\Models\Coalition\Traits\Attributes\CoalitionAttributes;
use App\Models\Coalition\Traits\Relations\CoalitionRelations;
use App\Models\Organization\Traits\Attributes\OrganizationAttributes;
use App\Models\Organization\Traits\Relations\OrganizationRelationships;
use App\Models\Traits\ModelAttributes;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 * @property mixed id
 * @property mixed name
 */
class Coalition extends BaseModel
{
    use ModelAttributes, CoalitionAttributes, HasUserstamps, CoalitionRelations;

    protected $fillable = [
        'name',
        'description'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
