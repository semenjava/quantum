<?php

namespace Modules\Auth\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Auth\Http\Actions\RegisterAction;

class RegistrationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return RegisterAction::class;
    }
}
