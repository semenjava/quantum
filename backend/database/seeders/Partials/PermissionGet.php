<?php

namespace Database\Seeders\Partials;

use App\Models\Permissions;

trait PermissionGet
{
    /**
     * @return Permissions[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getPermissions()
    {
        return Permissions::all();
    }
}
