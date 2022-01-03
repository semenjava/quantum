<?php

namespace Modules\Auth\Http\Actions;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Actions\BaseAction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Auth\Http\Requests\LoginRequest;
use App\Properties\Property;
use Modules\Auth\Entities\User;
use Modules\Auth\Entities\AuthToken;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Modules\Auth\Repositories\UserRepository;

class EditUserAction extends BaseAction
{
    /**
     * @param Property $dto
     * @return mixed
     */
    public static function edit(Property $dto)
    {
        $user = User::edit($dto);
        $response = $user->toArray();
        return $response;
    }
}
