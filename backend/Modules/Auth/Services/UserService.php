<?php

namespace Modules\Auth\Services;

use App\Models\User;
use Modules\Auth\Repositories\UserRepository;
use Modules\Auth\Multions\UserMultion;

class UserService
{
    private UserRepository $repository;

    public function __construct(UserMultion $multion)
    {
        $this->userRepository = $multion->getInstance('UserRepository');
        $this->facilityRepository = $multion->getInstance('FacilityRepository');
        $this->providerRepository = $multion->getInstance('ProviderRepository');
        $this->companyRepository = $multion->getInstance('CompanyRepository');
        $this->employeeRepository = $multion->getInstance('EmployeeRepository');
    }

    public function users(array $data)
    {
        $users = $this->userRepository->users($data);
        return $users;
    }

    public function getFacility(array $data)
    {
        $users = $this->facilityRepository->getFacility($data);
        return $users;
    }

    public function getProvider(array $data)
    {
        $users = $this->providerRepository->getProvider($data);
        return $users;
    }

    public function getCompany(array $data)
    {
        $users = $this->companyRepository->getCompany($data);
        return $users;
    }

    public function getEmployee(array $data)
    {
        $users = $this->employeeRepository->getEmployee($data);
        return $users;
    }
}
