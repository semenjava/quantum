<?php

namespace Database\Seeders\Partials;

use App\Models\Roles;

trait RolesGet
{
    public static function getRoles()
    {
        return Roles::all()->groupBy('slug');
    }
}
