<?php

namespace App\Models\Auth;

use App\Enums\UserStatus;
use Altek\Eventually\Eventually;
use Illuminate\Notifications\Notifiable;
use Altek\Accountant\Contracts\Recordable;
use Lab404\Impersonate\Models\Impersonate;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Auth\Traits\SendUserPasswordReset;
use Altek\Accountant\Recordable as RecordableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class BaseUser extends Authenticatable implements Recordable
{
    use Eventually,
        Impersonate,
        Notifiable,
        RecordableTrait,
        SendUserPasswordReset,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'profile_photo_path',
        'created_by',
        'updated_by',
        'password',
        'status',
    ];

    /**
     * The dynamic attributes from mutators that should be returned with the user object.
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => UserStatus::class,
    ];

    /**
     * @var array
     */
    protected $dates = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Return true or false if the user can impersonate an other user.
     *
     * @param void
     * @return  bool
     */
    public function canImpersonate()
    {
        return is_root();
    }

    /**
     * Return true or false if the user can be impersonate.
     *
     * @param void
     * @return  bool
     */
    public function canBeImpersonated()
    {
        return ! is_root();
    }
}
