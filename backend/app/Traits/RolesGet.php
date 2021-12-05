<?php

namespace App\Traits;

use Kodeine\Acl\Models\Eloquent\Role;

trait RolesGet
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|Role[]
     */
    public static function getRoles()
    {
        return Role::all()->keyBy('slug');
    }

    /**
     * @param array $slug
     * @return string
     */
    public static function slug(array $slug): string
    {
        return key($slug);
    }
}
