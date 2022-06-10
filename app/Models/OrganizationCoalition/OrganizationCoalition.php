<?php

namespace App\Models\OrganizationCoalition;

use App\Models\BaseModel;
use App\Models\Coalition\Coalition;
use App\Models\Organization\Traits\Attributes\OrganizationAttributes;
use App\Models\Organization\Traits\Relations\OrganizationRelationships;
use App\Models\Traits\ModelAttributes;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 * @property mixed id
 * @property mixed name
 */
class OrganizationCoalition extends BaseModel
{
    use ModelAttributes, HasUserstamps;

    protected $fillable = [
        'organization_id',
        'coalition_id'
    ];
    protected $table='organization_coalition';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    public function coalition()
    {
        return $this->belongsTo(Coalition::class);
    }
}
