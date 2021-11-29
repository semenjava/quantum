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

class AuthAction extends BaseAction
{
    public static function register(Property $dto) {
        $fields = $dto->toArray();

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password'])
        ]);

        $user->sendEmailVerificationNotification();

        $response = [
            'success' => true,
            'message' => 'A letter has been sent to your mail'
        ];

        return $response;
    }

    public static function verify(Property $dto)
    {
        if($userId = User::hasHashEmail($dto->get('hash'))) {
            $user = User::find($userId);
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
        $user = User::where('email', $fields['email'])->first();

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

    public static function logout(Property $dto) {
        request()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public static function edite(Property $dto)
    {
        $user = User::edite($dto);
        $response = $user->toArray();
        return $response;
    }
}
