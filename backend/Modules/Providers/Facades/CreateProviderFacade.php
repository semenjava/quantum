<?php

namespace Modules\Providers\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Providers\Http\Actions\CreateProviderAction;

class CreateProviderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CreateProviderAction::class;
    }
}
