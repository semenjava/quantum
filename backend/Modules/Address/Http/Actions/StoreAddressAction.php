<?php

namespace Modules\Address\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Address\Services\AddressService;

class StoreAddressAction extends BaseAction implements Action
{
    /**
     * @var AddressService
     */
    private AddressService $addressService;

    /**
     * @param AddressService $service
     */
    public function __construct(AddressService $service)
    {
        $this->addressService = $service;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function run(Property $dto)
    {
        if ($dto->has('provider_id') && \Gate::denies('store-provider-address', $dto->get('provider_id'))) {
            abort(403);
        }

        if ($dto->has('facility_id') && \Gate::denies('store-facility-address', $dto->get('facility_id'))) {
            abort(403);
        }

        if ($dto->has('company_id') && \Gate::denies('store-company-address', $dto->get('company_id'))) {
            abort(403);
        }

        if ($dto->has('employee_id') && \Gate::denies('store-employee-address', $dto->get('employee_id'))) {
            abort(403);
        }

        $address = $this->addressService->setParam($dto)->storeAdress();

        return $address;
    }
}
