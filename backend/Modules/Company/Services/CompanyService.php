<?php

namespace Modules\Company\Services;

use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use Modules\Company\Repositories\UserRepository;
use Modules\Company\Repositories\CompanyRepository;

class CompanyService extends BaseService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var CompanyRepository
     */
    private CompanyRepository $companyRepository;

    public function __construct(UserRepository $user, CompanyRepository $company)
    {
        $this->userRepository = $user;
        $this->companyRepository = $company;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createCompany()
    {
        $user = $this->userRepository->create([
            'name' => $this->dto->get('name'),
            'email' => $this->dto->get('email'),
            'password' => $this->dto->has('password') ? Hash::make($this->dto->get('password')) : Hash::make($this->dto->get('name')),
            'role' => User::COMPANY,
            'time_zone' =>  $this->dto->has('time_zone') ? $this->dto->get('time_zone') : User::TIME_ZONE_DEFAULT
        ]);

        $this->dto->remove('email');
        $this->dto->remove('password');

        $this->dto->set('user_id', $user->id);

        $facility = $this->companyRepository->create($this->dto->all());

        activity()->performedOn($user)
            ->causedBy($facility)
            ->withProperties(['user_id' => request()->user()->id, 'create_company_id' => $facility->id])
            ->log('Create user to role company');

        return $facility;
    }
}
