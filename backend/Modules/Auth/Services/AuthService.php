<?php

namespace Modules\Auth\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Exceptions\NotAuthorized;
use Modules\Auth\Entities\User as UserEntity;
use Modules\Auth\Repositories\UserRepository;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Spatie\Activitylog\Models\Activity;

class AuthService
{
    /**
     * @var User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $user;

    /**
     * @param User|null $user
     */
    public function __construct(User $user = null)
    {
        $this->user = is_null($user) ? Auth::user() : $user;
    }

    /**
     * @param $fields
     * @return array
     * @throws NotAuthorized
     */
    public function login($fields)
    {
        if (!$user_id = UserEntity::hasEmailUser($fields['email'])) {
            //Unauthenticated
            throw new NotAuthorized();
        }

        // Check email
        $user =  UserRepository::init()->getById($user_id);

        // Check password
        if (!$user || !UserEntity::hasPasswordHash($fields['password'], $user)) {
            //Unauthenticated
            throw new NotAuthorized();
        }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $user->api_token = $token;
        $user->save();

        activity()->performedOn($user)
            ->causedBy($user)
            ->withProperties(['user_id' => $user->id, 'api_token' => $token])
            ->log('User use login');

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return $response;
    }

    /**
     * @param $dto
     * @return array
     * @throws AuthorizationException
     */
    public function verify($dto)
    {
        if ($userId = UserEntity::hasHash($dto->get('hash'))) {
            $user = UserRepository::init()->getById($userId);
            $token = $user->createToken('myapptoken')->plainTextToken;
            $user->api_token = $token;
            $user->save();

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return $response;
        }

        throw new AuthorizationException();
    }
}
