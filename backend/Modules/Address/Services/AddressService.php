<?php

namespace Modules\Address\Services;

use App\Models\Address;
use App\Models\Companies;
use App\Models\Employees;
use App\Models\Facilities;
use App\Repositories\LocationRepository;
use App\Services\BaseService;
use App\Models\Provider;
use App\Traits\UserAddress;

class AddressService extends BaseService
{
    use UserAddress;

    /**
     * @var LocationRepository
     */
    private LocationRepository $locationRepository;

    /**
     * @param LocationRepository $location
     */
    public function __construct(LocationRepository $location)
    {
        $this->locationRepository = $location;
    }

    /**
     * @return mixed
     */
    public function storeAddress()
    {
        $this->instanceUserAddress();

        $address = $this->locationRepository->create($this->dto->all());

        $this->userAddress->addresses()->attach($address);

        activity()->performedOn(request()->user())
            ->causedBy($this->userAddress->user)
            ->withProperties(['user_id' => request()->user()->id, 'user_address_id' => $this->userAddress->id, 'address' => $address->toJson()])
            ->log('User use create provider address');

        return $address;
    }

    /**
     * @return $this
     */
    public function clearAdressUser()
    {
        $this->userAddress->addresses()->delete();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddresses()
    {
        $this->instanceUserAddress();

        return $this->userAddress->addresses()->get();
    }

    public function deleteAllAddresses()
    {
        $this->instanceUserAddress();

        return $this->userAddress->addresses()->delete();
    }
}
