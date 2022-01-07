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
     * @param Property $dto
     * @return void
     */
    public function gateUser(Property $dto)
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
    }



    /**
     * Store a newly created resource in storage.
     */
    public function run(Property $dto)
    {
        $address = $this->addressService->setParam($dto)->storeAddress();

        return $address;
    }

    public function storeAddress(array $dtos): array
    {
        $result = [];

        foreach ($dtos as $dto) {
            $this->gateUser($dto);
            $this->addressService->setParam($dto)->instanceUserAddress()->clearAdressUser();
        }

        foreach ($dtos as $dto) {
            $result[] = $this->run($dto);
        }

        return $result;
    }

    public function deleteAllAddresses(Property $dto)
    {
        $this->gateUser($dto);

        $this->addressService->setParam($dto)->deleteAllAddresses();
        return [];
    }
}
