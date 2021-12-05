<?php

namespace Modules\Auth\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Exceptions\NotAuthorized;
use Modules\Auth\Entities\User as UserEntity;
use Modules\Auth\Repositories\UserRepository;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;

class AuthService
{
    private $user;

    public function __construct(User $user = null)
    {
        $this->user = is_null($user) ? Auth::user() : $user;
    }

    public function login($fields, $user)
    {
        if($user_id = UserEntity::hasEmailUser($fields['email'])) {
            //Unauthenticated
            throw new NotAuthorized();
        }

        // Check email
        $user =  UserRepository::init()->getById($user_id);

        // Check password
        if(!$user || !UserEntity::hasPasswordHash($fields['password'], $user)) {
             //Unauthenticated
            throw new NotAuthorized();
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

    public function verify($dto)
    {
        if($userId = UserEntity::hasHash($dto->get('hash'))) {
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
}
