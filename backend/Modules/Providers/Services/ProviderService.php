<?php

namespace Modules\Providers\Services;

use App\Models\User;
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
        $user = $this->userRepository->create([
            'name' => $this->dto->get('first_name'),
            'email' => $this->dto->get('email'),
            'password' => $this->dto->has('password') ? Hash::make($this->dto->get('password')) : Hash::make($this->dto->get('first_name')),
            'role' => User::PROVIDER
        ]);

        $this->dto->remove('email');
        $this->dto->remove('password');

        $this->dto->set('user_id', $user->id);

        $this->dto->rename('language', '2nd_language');

        $provider = $this->providerRepository->create($this->dto->all());

        activity()->performedOn($user)
            ->causedBy($provider)
            ->withProperties(['user_id' => request()->user()->id, 'create_provider_id' => $provider->id])
            ->log('Create user to role provider');

        return $provider;
    }
}
