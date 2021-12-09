<?php

namespace Modules\Providers\Services;

use App\Properties\Property;
use Hash;
use App\Repositories\LocationRepository;
use Modules\Providers\Repositories\UserRepository;
use Modules\Providers\Repositories\ProviderRepository;

class ProviderService
{
    private $dto = null;

    public function __construct(Property $dto)
    {
        $this->dto = $dto;
    }

    public function createProvider()
    {
        $userData = [];
        $userData['name'] = $this->dto->get('name');
        $userData['email'] = $this->dto->get('email');
        $userData['password'] = $this->dto->has('password') ? Hash::make($this->dto->get('password')) : Hash::make($this->dto->get('name'));
        $user = UserRepository::init()->create($userData);

        $this->dto->remove('email');
        $this->dto->remove('password');

        $location = new LocationRepository();
        $data = $location->save($this->dto->all());

        $this->dto->remove('country');
        $this->dto->remove('region');
        $this->dto->remove('city');

        $this->dto->set('country_id', $data['country_id']);
        $this->dto->set('city_id', $data['city_id']);

        $facilityData = $this->dto->all();
        $provider = ProviderRepository::init()->create($facilityData);

        activity()->performedOn($user)
            ->causedBy($provider)
            ->withProperties(['user_id' => request()->user()->id, 'create_provider_id' => $user->id])
            ->log('User use create provider');

        return $provider;
    }
}
