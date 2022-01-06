<?php

namespace Modules\Address\Services;

use App\Models\Address;
use App\Models\ProviderAddress;
use App\Repositories\LocationRepository;
use App\Services\BaseService;
use App\Models\User;
use App\Models\Provider;

class AddressService extends BaseService
{
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
    public function storeAdress()
    {
        $provider = Provider::find($this->dto->get('provider_id'));

        $address = $this->locationRepository->save($this->dto->all());

        if (!$provider->address($address->id)) {
            $provider->addresses()->attach($address);
        }

        activity()->performedOn(request()->user())
            ->causedBy($provider->user)
            ->withProperties(['user_id' => request()->user()->id, 'provider_id' => $provider->id, 'address' => $address->toJson()])
            ->log('User use create provider address');

        return $address;
    }
}
