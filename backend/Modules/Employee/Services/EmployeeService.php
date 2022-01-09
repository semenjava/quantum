<?php

namespace Modules\Employee\Services;

use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use Modules\Employee\Repositories\UserRepository;
use Modules\Employee\Repositories\EmployeeRepository;

class EmployeeService extends BaseService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var EmployeeRepository
     */
    private EmployeeRepository $employeeRepository;

    public function __construct(UserRepository $user, EmployeeRepository $employee)
    {
        $this->userRepository = $user;
        $this->employeeRepository = $employee;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createEmployee()
    {
        $user = $this->userRepository->create([
            'name' => $this->dto->get('first_name'),
            'email' => $this->dto->get('email'),
            'password' => $this->dto->has('password') ? Hash::make($this->dto->get('password')) : Hash::make($this->dto->get('first_name')),
            'role' => User::EMPLOYEE
        ]);

        $this->dto->remove('email');
        $this->dto->remove('password');

        $this->dto->set('user_id', $user->id);

        $employee = $this->employeeRepository->create($this->dto->all());

        activity()->performedOn($user)
            ->causedBy($employee)
            ->withProperties(['user_id' => request()->user()->id, 'create_employee_id' => $employee->id])
            ->log('Create user to role employee');

        return $employee;
    }
}
