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

    public function getFacility(array $data)
    {
        $users = $this->repository->getFacility($data);
        return $users;
    }

    public function getProvider(array $data)
    {
        $users = $this->repository->getProvider($data);
        return $users;
    }

    public function getCompany(array $data)
    {
        $users = $this->repository->getCompany($data);
        return $users;
    }

    public function getEmployee(array $data)
    {
        $users = $this->repository->getEmployee($data);
        return $users;
    }
}
