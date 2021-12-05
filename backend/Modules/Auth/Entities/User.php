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
        $result = DB::table('users')->select('user_id')->where('hash', $hash)->first();
        return $result ? $result->user_id : null;
    }

    /**
     * @param $email
     * @return mixed|null
     */
    public static function hasEmailUser($email)
    {
        $result = DB::table('user')->select('user_id')->where('email', $email)->first();
        return $result ? $result->user_id : null;
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
    public function edite(Property $dto)
    {
        $user = request()->user();
        $user->lang = $dto->get('lang');
        $user->time_zone = $dto->get('time_zone');
        $user->save();

        return $user;
    }
}
