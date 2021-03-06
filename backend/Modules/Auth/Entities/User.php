<?php

namespace Modules\Auth\Entities;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User as BaseUser;
use Modules\Auth\Notifications\VerifyEmail;
use App\Properties\Property;

class User extends BaseUser
{
    /**
     * @param $hash
     * @return mixed|null
     */
    public static function hasHash($hash)
    {
        $result = DB::table('users')->select('id')->where('hash', $hash)->first();
        return $result ? $result->id : null;
    }

    /**
     * @param $email
     * @return mixed|null
     */
    public static function hasEmailUser($email)
    {
        $result = DB::table('users')->select('id')->where('email', $email)->first();
        return $result ? $result->id : null;
    }

    /**
     * @param $password
     * @param $user
     * @return bool
     */
    public static function hasPasswordHash($password, $user)
    {
        return Hash::check($password, $user->password);
    }

    /**
     * @param Property $dto
     * @return mixed
     */
    public static function edit(Property $dto)
    {
        $user = self::find($dto->get('user_id'));
        $user->fill($dto->all());
        $user->save();

        return $user;
    }
}
