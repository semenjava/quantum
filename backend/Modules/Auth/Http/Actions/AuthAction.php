<?php

namespace Modules\Auth\Http\Actions;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Actions\BaseAction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Facades\AuthFacade;
use Modules\Auth\Http\Requests\LoginRequest;
use App\Properties\Property;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\AuthToken;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Modules\Auth\Repositories\UserRepository;

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
