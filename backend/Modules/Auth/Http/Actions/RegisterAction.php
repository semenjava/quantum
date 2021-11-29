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

class RegisterAction extends BaseAction
{
    /**
     * @param Property $dto
     * @return array
     */
    public static function register(Property $dto) {
        $fields = $dto->toArray();

        $user = UserRepository::init()->create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password'])
        ]);

        // send email verification
        $user->sendEmailVerificationNotification();

        $response = [
            'success' => true,
            'message' => 'A letter has been sent to your mail'
        ];

        return $response;
    }
}
