<?php

namespace Modules\Auth\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Auth\Services\UserService;

class GetEmployeeAction extends BaseAction implements Action
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function run(Property $dto)
    {
        if (\Gate::denies('read-employee')) {
            abort(403);
        }

        return $this->service->getEmployee($dto->all());
    }
}
