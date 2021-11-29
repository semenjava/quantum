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

class AuthAction extends BaseAction
{
    public static function verify(Property $dto)
    {
        if($userId = User::hasHashEmail($dto->get('hash'))) {
            $user = UserRepository::init()->getById($userId);
            $token = $user->createToken('myapptoken')->plainTextToken;
            $user->api_token = $token;
            $user->save();

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return $response;
        } else {
            throw new AuthorizationException();
        }
    }

    public static function login(Property $dto) {
        $fields = $dto->toArray();

        // Check email
        $user = UserRepository::init()->where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return [
                'message' => 'Bad creds'
            ];
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $user->api_token = $token;
        $user->save();

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $response;
    }
}
