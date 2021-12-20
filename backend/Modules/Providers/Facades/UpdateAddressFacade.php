<?php

namespace Modules\Providers\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Address\Http\Actions\UpdateAddressAction;

class UpdateAddressFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UpdateAddressAction::class;
    }
}
