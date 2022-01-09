<?php

namespace Modules\Auth\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Auth\Services\UserService;

class GetFacilityAction extends BaseAction implements Action
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
        if (\Gate::denies('read-facility')) {
            abort(403);
        }

        return $this->service->getFacility($dto->all());
    }
}
