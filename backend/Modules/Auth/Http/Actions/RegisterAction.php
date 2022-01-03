<?php

namespace Modules\Auth\Http\Actions;

use App\Http\Actions\BaseAction;
use Illuminate\Support\Facades\Hash;
use App\Properties\Property;
use Modules\Auth\Repositories\UserRepository;
use App\Contract\Action;

class RegisterAction extends BaseAction implements Action
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
    public function run(Property $dto)
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
            \Log::debug($e->getMessage());
        }

        return $user->toArray();
    }
}
