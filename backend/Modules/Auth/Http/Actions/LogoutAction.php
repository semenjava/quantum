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
use Spatie\Activitylog\Models\Activity;

class LogoutAction extends BaseAction
{
    /**
     * @param Property $dto
     * @return string[]
     */
    public static function logout()
    {
        request()->user()->tokens()->delete();

        activity()->performedOn(request()->user())
            ->causedBy(request()->user())
            ->withProperties(['user_id' => request()->user()->id, 'api_token' => null])
            ->log('User use Logged out');

        return [
            'success' => true,
            'message' => 'Logged out'
        ];
    }
}
