<?php

namespace Modules\Facilities\Http\Actions;

use App\Http\Actions\BaseAction;
use App\Contract\Action;
use App\Properties\Property;
use Modules\Facilities\Services\FacilityService;

class CreateFacilityAction extends BaseAction implements Action
{
    private $facilityService;

    public function __construct(FacilityService $service)
    {
        $this->facilityService = $service;
    }

    public function run(Property $dto)
    {
        if (\Gate::denies('create-facility')) {
            abort(403);
        }

        return $this->facilityService->setParam($dto)->createFacility();
    }
}
