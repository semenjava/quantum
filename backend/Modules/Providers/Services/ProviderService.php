<?php

namespace Modules\Providers\Services;

use Hash;
use App\Repositories\LocationRepository;
use Modules\Facilities\Repositories\FacilityRepository;
use Modules\Providers\Repositories\UserRepository;
use Modules\Providers\Repositories\ProviderRepository;
use App\Services\BaseService;

class ProviderService extends BaseService
{
    /**
     * @var \Modules\Facilities\Repositories\UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var LocationRepository
     */
    private LocationRepository $locationRepository;

    /**
     * @var ProviderRepository
     */
    private ProviderRepository $providerRepository;

    /**
     * @param UserRepository $user
     * @param LocationRepository $local
     * @param FacilityRepository $facility
     */
    public function __construct(UserRepository $user, LocationRepository $local, ProviderRepository $provider)
    {
        $this->userRepository = $user;
        $this->locationRepository = $local;
        $this->providerRepository = $provider;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createProvider()
    {
        $userData = [];
        $userData['name'] = $this->dto->get('name');
        $userData['email'] = $this->dto->get('email');
        $userData['password'] = $this->dto->has('password') ? Hash::make($this->dto->get('password')) : Hash::make($this->dto->get('name'));
        $user = $this->userRepository->create($userData);

        $this->dto->remove('email');
        $this->dto->remove('password');

        $data = $this->locationRepository->save($this->dto->all());

        $this->dto->remove('country');
        $this->dto->remove('region');
        $this->dto->remove('city');

        $this->dto->set('country_id', $data['country_id']);
        $this->dto->set('city_id', $data['city_id']);

        $provider = $this->providerRepository->create($this->dto->all());
        foreach ($data['addresses'] as $address) {
            $provider->addresses()->attach($address);
        }

        activity()->performedOn($user)
            ->causedBy($provider)
            ->withProperties(['user_id' => request()->user()->id, 'create_provider_id' => $user->id])
            ->log('User use create provider');

        return $provider;
    }
}
