<?php

namespace Modules\Auth\Http\Actions;

use App\Http\Actions\BaseAction;
use Modules\Auth\Facades\AuthFacade;
use App\Properties\Property;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use App\Models\Countries;

class AuthAction extends BaseAction
{
    /**
     * @param Property $dto
     * @return array
     * @throws AuthorizationException
     */
    public static function verify(Property $dto)
    {
        return AuthFacade::verify($dto);
    }

    /**
     * @param Property $dto
     * @return array|string[]
     */
    public static function login(Property $dto)
    {
        $response = AuthFacade::login($dto->toArray());
        return $response;
    }
}
