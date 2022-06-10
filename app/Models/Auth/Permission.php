<?php

namespace App\Models\Auth;

use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use App\Models\Traits\ModelAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\Attributes\PermissionAttributes;
use App\Models\Auth\Traits\Relationships\PermissionRelationships;

/**
 * Class Permission.
 * @property string name
 * @property string display_name
 * @property int sort
 * @property int created_by
 * @property int|null updated_by
 * @property Carbon|null created_at
 * @property Carbon|null updated_at
 * @property Carbon|null deleted_at
 */
class Permission extends BaseModel
{
    use ModelAttributes, SoftDeletes, PermissionAttributes, PermissionRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'sort'];

    protected $attributes = [
        'created_by' => 1,
    ];
}
