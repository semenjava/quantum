<?php

namespace Modules\Address\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Address\Http\Actions\CreateAddressAction;

class CreateAddressFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CreateAddressAction::class;
    }
}
