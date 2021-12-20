<?php

namespace Modules\Address\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Address\Http\Actions\CreateAddressAction;

class UpdateAddressFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CreateAddressAction::class;
    }
}
