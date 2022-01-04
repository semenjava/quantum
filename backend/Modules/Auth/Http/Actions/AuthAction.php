<?php

namespace Modules\Auth\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use Modules\Auth\Facades\AuthFacade;
use App\Properties\Property;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;

class AuthAction extends BaseAction implements Action
{
    /**
     * @param Property $dto
     * @return array
     * @throws AuthorizationException
     */
    public function verify(Property $dto)
    {
        return AuthFacade::verify($dto);
    }

    /**
     * @param Property $dto
     * @return array|string[]
     */
    public function login(Property $dto)
    {
        $response = AuthFacade::login($dto->toArray());
        return $response;
    }

    public function run(Property $dto)
    {
        // TODO: Implement run() method.
    }
}
