<?php

namespace App\Services;

use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class Access.
 */
class Access
{
    /**
     * Return if the current session user is a guest or not.
     */
    public function guest(): mixed
    {
        return auth()->guest();
    }

    public function logout(): void
    {
        auth()->logout();
    }

    /**
     * Get the currently authenticated user's id.
     */
    public function id(): int|null|string
    {
        return auth()->id();
    }

    public function login(Authenticatable $user, bool $remember = false): void
    {
        auth()->login($user, $remember);
    }

    /**
     * @param $id
     * @return bool|Authenticatable
     */
    public function loginUsingId($id): bool|Authenticatable
    {
        return auth()->loginUsingId($id);
    }

    /**
     * Checks if the current user has a Role by its name or id.
     *
     * @param string $role Role name.
     *
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        if ($user = $this->user()) {
            return $user->hasRole($role);
        }

        return false;
    }

    /**
     * Get the currently authenticated user or null.
     */
    public function user(): ?Authenticatable
    {
        return auth()->user();
    }

    /**
     * Checks if the user has either one or more, or all of an array of roles.
     *
     * @param  $roles
     * @param bool $needsAll
     *
     * @return bool
     */
    public function hasRoles($roles, $needsAll = false)
    {
        if ($user = $this->user()) {
            return $user->hasRoles($roles, $needsAll);
        }

        return false;
    }

    /**
     * @param  $permission
     *
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->allow($permission);
    }

    /**
     * Check if the current user has a permission by its name or id.
     *
     * @param string $permission Permission name or id.
     *
     * @return bool
     */
    public function allow($permission)
    {
        if ($user = $this->user()) {
            return $user->allow($permission);
        }

        return false;
    }

    /**
     * @param  $permissions
     * @param  $needsAll
     *
     * @return bool
     */
    public function hasPermissions($permissions, $needsAll = false)
    {
        return $this->allowMultiple($permissions, $needsAll);
    }

    /**
     * Check an array of permissions and whether or not all are required to continue.
     *
     * @param  $permissions
     * @param  $needsAll
     *
     * @return bool
     */
    public function allowMultiple($permissions, $needsAll = false)
    {
        if ($user = $this->user()) {
            return $user->allowMultiple($permissions, $needsAll);
        }

        return false;
    }
}
