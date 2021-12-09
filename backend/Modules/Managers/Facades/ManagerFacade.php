<?php

namespace Modules\Managers\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Managers\Http\Actions\CreateManagerAction;

class ManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CreateManagerAction::class;
    }
}
