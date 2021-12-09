<?php

namespace Modules\Auth\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Auth\Services\AuthService;

class AuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AuthService::class;
    }
}
