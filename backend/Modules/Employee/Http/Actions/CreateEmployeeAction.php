<?php

namespace Modules\Employee\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Employee\Services\EmployeeService;

class CreateEmployeeAction extends BaseAction implements Action
{
    private $employeeService;

    public function __construct(EmployeeService $service)
    {
        $this->employeeService = $service;
    }

    public function run(Property $dto)
    {
        if (\Gate::denies('create-employee')) {
            abort(403);
        }

        return $this->employeeService->setParam($dto)->createEmployee();
    }
}
