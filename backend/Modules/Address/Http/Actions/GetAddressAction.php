<?php

namespace Modules\Address\Http\Actions;

use App\Contract\Action;
use App\Http\Actions\BaseAction;
use App\Properties\Property;
use Modules\Address\Services\AddressService;

class GetAddressAction extends BaseAction implements Action
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
     * Get addresses list
     */
    public function run(Property $dto)
    {
        $addresses = $this->addressService->setParam($dto)->getAddresses();

        return $addresses;
    }
}
