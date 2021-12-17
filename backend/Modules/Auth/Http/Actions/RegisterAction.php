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
use App\Traits\DateTimeTrait;

class RegisterAction extends BaseAction
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->userRepository = $user;
    }

    /**
     * @param Property $dto
     * @return array
     */
    public function register(Property $dto)
    {
        $fields = $dto->toArray();

        $user = $this->userRepository->create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
            'role' => $fields['role'],
            'time_zone' => $fields['time_zone']
        ]);

        // send email verification
        try {
            $user->sendEmailVerificationNotification();
        } catch (\Exception $e) {

        }

        return $user->toArray();
    }
}
