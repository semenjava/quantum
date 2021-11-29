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
    public static function hasHashEmail($hash)
    {
        $result = DB::table('user_signe')->select('user_id')->where('hash', $hash)->first();
        return $result['user_id'];
    }

    public function edite(Property $dto)
    {
        $user = request()->user();
        $user->lang = $dto->get('lang');
        $user->time_zone = $dto->get('time_zone');
        $user->save();

        return $user;
    }
}
