<?php

namespace App\Models\Vendor;

use App\Models\BaseModel;
use App\Models\Vendor\Traits\Attributes\VendorAttributes;
use App\Models\Vendor\Traits\Relationships\VendorRelationships;
use App\Models\Traits\ModelAttributes;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 * @property mixed id
 * @property mixed name
 */
class Vendor extends BaseModel
{
    use ModelAttributes, VendorAttributes, HasUserstamps, VendorRelationships;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'description',
        'status',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
