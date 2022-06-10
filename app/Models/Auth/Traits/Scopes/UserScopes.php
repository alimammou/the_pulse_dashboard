<?php

namespace App\Models\Auth\Traits\Scopes;

use App\Enums\UserStatus;

trait UserScopes
{
    /**
     * @param $query
     * @param string $status
     *
     * @return mixed
     */
    public function scopeActive($query, string $status = UserStatus::Active)
    {
        return $query->where('status', $status);
    }
}
