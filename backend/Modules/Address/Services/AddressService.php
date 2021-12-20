<?php

namespace Modules\Address\Services;

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
        $provider = Provider::find($this->dto->get('provider_id'))->load('user');
        $user = $provider->user;

        $this->locationRepository->save($this->dto->all());

        $provider->addresses()->attach($this->dto->all());

        activity()->performedOn($provider)
            ->causedBy($provider->addresses())
            ->withProperties(['user_id' => request()->user()->id, 'create_provider_address' => $user->id])
            ->log('User use create provider address');

        return $provider->addresses();
    }
}
