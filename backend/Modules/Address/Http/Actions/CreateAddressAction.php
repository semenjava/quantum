<?php

namespace Modules\Address\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Address\Services\AddressService;

class CreateAddressAction extends BaseAction implements Action
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
        if (\Gate::denies('update-own-provider-address')) {
            abort(403);
        }

        $address = $this->addressService->setParam($dto)->storeAdress();

        return $address->toArray();
    }
}
