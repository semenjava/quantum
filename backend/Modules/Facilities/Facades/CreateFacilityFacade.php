<?php

namespace Modules\Facilities\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Facilities\Http\Actions\CreateFacilityAction;

class CreateFacilityFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CreateFacilityAction::class;
    }
}
