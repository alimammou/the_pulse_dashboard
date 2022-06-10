<?php

namespace App\Models\Auth\Traits\Access;

trait UserAccess
{
    public function hasRoles(mixed $roles, bool $needsAll = false): bool
    {
        //If not an array, make a one item array
        if (! is_array($roles)) {
            $roles = [$roles];
        }

        //User has to possess all of the roles specified
        if ($needsAll) {
            $hasRoles = 0;
            $numRoles = count($roles);

            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    $hasRoles++;
                }
            }

            return $numRoles == $hasRoles;
        }

        //User has to possess one of the roles specified
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole(string $nameOrId): bool
    {
        foreach ($this->roles as $role) {
            //See if role has all permissions
            if ($role->all) {
                return true;
            }

            //First check to see if it's an ID
            if (is_numeric($nameOrId)) {
                if ($role->id == $nameOrId) {
                    return true;
                }
            }

            //Otherwise check by name
            if ($role->name == $nameOrId) {
                return true;
            }
        }

        return false;
    }

    public function hasPermission(string $nameOrId): bool
    {
        return $this->allow($nameOrId);
    }

    public function allow(string $nameOrId): bool
    {
        // Update for this function due to issue of user custom permission

        //Check permissions directly tied to user
        foreach ($this->permissions as $perm) {
            //First check to see if it's an ID
            if (is_numeric($nameOrId)) {
                if ($perm->id == $nameOrId) {
                    return true;
                }
            }

            //Otherwise check by name
            if ($perm->name == $nameOrId) {
                return true;
            }
        }

        foreach ($this->roles as $role) {
            // See if role has all permissions
            if ($role->all) {
                return true;
            }

            /*
             *
             * below code is commented due to issue of user custom permisssion
             * if this code is not commented then if user dont have permission of one module but role which is assigned to that user have that permission than allow() method return true
             *
             */

            // Validate against the Permission table
            /*foreach ($role->permissions as $perm) {

                // First check to see if it's an ID
                if (is_numeric($nameOrId)) {
                    if ($perm->id == $nameOrId) {
                        return true;
                    }
                }

                // Otherwise check by name
                if ($perm->name == $nameOrId) {
                    return true;
                }
            }*/
        }

        return false;
    }

    public function hasPermissions($permissions, bool $needsAll = false)
    {
        return $this->allowMultiple($permissions, $needsAll);
    }

    public function allowMultiple(array $permissions, bool $needsAll = false): bool
    {
        //If not an array, make a one item array
        if (! is_array($permissions)) {
            $permissions = [$permissions];
        }

        //User has to possess all of the permissions specified
        if ($needsAll) {
            $hasPermissions = 0;
            $numPermissions = count($permissions);

            foreach ($permissions as $perm) {
                if ($this->allow($perm)) {
                    $hasPermissions++;
                }
            }

            return $numPermissions == $hasPermissions;
        }

        //User has to possess one of the permissions specified
        foreach ($permissions as $perm) {
            if ($this->allow($perm)) {
                return true;
            }
        }

        return false;
    }

    public function attachRoles(iterable $roles)
    {
        foreach ($roles as $role) {
            $this->attachRole($role);
        }
    }

    public function attachRole(mixed $role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->attach($role);
    }

    public function detachRoles(mixed $roles)
    {
        foreach ($roles as $role) {
            $this->detachRole($role);
        }
    }

    public function detachRole(mixed $role)
    {
        if (is_object($role)) {
            $role = $role->getKey();
        }

        if (is_array($role)) {
            $role = $role['id'];
        }

        $this->roles()->detach($role);
    }

    public function attachPermissions(iterable $permissions)
    {
        foreach ($permissions as $permission) {
            $this->attachPermission($permission);
        }
    }

    public function attachPermission(mixed $permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->attach($permission);
    }

    public function detachPermissions(iterable $permissions)
    {
        foreach ($permissions as $permission) {
            $this->detachPermission($permission);
        }
    }

    public function detachPermission(mixed $permission)
    {
        if (is_object($permission)) {
            $permission = $permission->getKey();
        }

        if (is_array($permission)) {
            $permission = $permission['id'];
        }

        $this->permissions()->detach($permission);
    }
}
