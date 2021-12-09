<?php

namespace Modules\Facilities\Http\Actions;

use App\Http\Actions\BaseAction;
use App\Contract\Action;
use App\Properties\Property;
use Modules\Facilities\Services\FacilityService;

class CreateFacilityAction extends BaseAction implements Action
{
    public function run(Property $dto)
    {
        if (\Gate::denies('create-facility')) {
            abort(403);
        }

        $service = new FacilityService($dto);
        $service->createFacility();

        return [
            'success' => true,
            'message' => 'Create Facility'
        ];
    }
}
