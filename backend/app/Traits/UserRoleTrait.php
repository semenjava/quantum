<?php

namespace App\Traits;

use App\Models\User;

trait UserRoleTrait
{
    public function addPermissions(User $user)
    {
        $roles = RolesGet::getRoles();

        $user->roles()->attach($roles->get($user->role));
        foreach ($roles->get($user->role)->permissions as $permission) {
            $user->permissions()->attach($permission);
        }
    }
}
