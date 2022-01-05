<?php

namespace Modules\Address\Services;

use App\Models\Address;
use App\Models\Companies;
use App\Models\Employees;
use App\Models\Facilities;
use App\Repositories\LocationRepository;
use App\Services\BaseService;
use App\Models\Provider;

class AddressService extends BaseService
{
    /**
     * @var LocationRepository
     */
    private LocationRepository $locationRepository;

    private $userAddress;

    /**
     * @param LocationRepository $location
     */
    public function __construct(LocationRepository $location)
    {
        $this->locationRepository = $location;
    }

    public function instanceUserAddess()
    {
        if ($this->dto->has('provider_id')) {
            $this->userAddress = Provider::find($this->dto->get('provider_id'));
        }

        if ($this->dto->has('facility_id')) {
            $this->userAddress = Facilities::find($this->dto->get('facility_id'));
        }

        if ($this->dto->has('company_id')) {
            $this->userAddress = Companies::find($this->dto->get('company_id'));
        }

        if ($this->dto->has('employee_id')) {
            $this->userAddress = Employees::find($this->dto->get('employee_id'));
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function storeAdress()
    {
        if(!$this->userAddress) {
            $this->instanceUserAddess();
        }

        $address = $this->locationRepository->create($this->dto->all());

        if (!$this->userAddress->address($address->id)) {
            $this->userAddress->addresses()->attach($address);
        }

        activity()->performedOn(request()->user())
            ->causedBy($this->userAddress->user)
            ->withProperties(['user_id' => request()->user()->id, 'user_address_id' => $this->userAddress->id, 'address' => $address->toJson()])
            ->log('User use create provider address');

        return $address;
    }

    public function clearAdressUser()
    {
        $this->userAddress->addresses()->delete();

        return $this;
    }
}
