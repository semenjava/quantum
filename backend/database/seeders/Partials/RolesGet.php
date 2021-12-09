<?php

namespace Database\Seeders\Partials;

use Kodeine\Acl\Models\Eloquent\Role;

trait RolesGet
{
    public static function getRoles()
    {
        return Role::all()->keyBy('slug');
    }
}
