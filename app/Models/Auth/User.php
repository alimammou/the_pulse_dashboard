<?php

namespace App\Models\Auth;

use App\Enums\UserStatus;
use Illuminate\Auth\MustVerifyEmail;
use Laravel\Passport\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use App\Models\Auth\Traits\Access\UserAccess;
use App\Models\Auth\Traits\Scopes\UserScopes;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Fortify\TwoFactorAuthenticatable;
use App\Models\Auth\Traits\Methods\UserMethods;
use App\Models\Auth\Traits\Attributes\UserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Auth\Traits\Relationships\UserRelationships;

/**
 * Class User.
 * @property mixed roles
 * @property mixed permissions
 * @property mixed name
 * @property mixed avatar_type
 * @property mixed id
 * @property UserStatus status
 * @property bool is_root
 */
class User extends BaseUser
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, UserAttributes, UserScopes, UserAccess, UserRelationships, UserMethods;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable,MustVerifyEmail;
}
