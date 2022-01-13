<?php

namespace Modules\Auth\Multions;

use App\Multions\MultionInterface;
use App\Multions\MultionTrait;
use Modules\Auth\Repositories\UserRepository;
use Modules\Auth\Repositories\FacilityRepository;
use Modules\Auth\Repositories\ProviderRepository;
use Modules\Auth\Repositories\CompanyRepository;
use Modules\Auth\Repositories\EmployeeRepository;

class UserMultion implements MultionInterface
{
    use MultionTrait;

    /**
     * @var Repositories
     */
    protected $userRepository;
    protected $facilityRepository;
    protected $providerRepository;
    protected $companyRepository;
    protected $employeeRepository;

    public function __construct(
        UserRepository $userRepository,
        FacilityRepository $facilityRepository,
        ProviderRepository $providerRepository,
        CompanyRepository $companyRepository,
        EmployeeRepository $employeeRepository
    ) {
        $this->userRepository    = $userRepository;
        $this->facilityRepository    = $facilityRepository;
        $this->providerRepository    = $providerRepository;
        $this->companyRepository    = $companyRepository;
        $this->employeeRepository    = $employeeRepository;
    }
}
