<?php

namespace Modules\Auth\Services;

use App\Models\User;
use Modules\Auth\Repositories\UserRepository;

class UserService
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function users(array $data)
    {
        $users = $this->repository->users($data);
        return $users;
    }
}
