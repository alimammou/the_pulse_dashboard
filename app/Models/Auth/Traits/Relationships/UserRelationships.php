<?php

namespace App\Models\Auth\Traits\Relationships;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Auth\Permission;
use App\Models\Auth\SocialAccount;
use App\Models\Auth\PasswordHistory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait UserRelationships
{
    public function providers(): HasMany
    {
        return $this->hasMany(SocialAccount::class);
    }

    /**
     * @return mixed
     */
    public function passwordHistories(): HasMany
    {
        return $this->hasMany(PasswordHistory::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
