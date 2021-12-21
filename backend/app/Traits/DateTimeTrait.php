<?php

namespace App\Traits;

use Kodeine\Acl\Models\Eloquent\Role;

trait DateTimeTrait
{
    public function getTimeZoneList()
    {
        $timezone_identifiers = \DateTimeZone::listIdentifiers();
        return $timezone_identifiers;
    }
}
