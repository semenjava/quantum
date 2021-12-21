<?php

namespace Modules\Facilities\Services;

use Modules\Facilities\Repositories\FacilityRepository;
use Hash;
use App\Repositories\LocationRepository;
use Modules\Facilities\Repositories\UserRepository;
use App\Services\BaseService;

class FacilityService extends BaseService
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @var LocationRepository
     */
    private LocationRepository $locationRepository;

    /**
     * @var FacilityRepository
     */
    private FacilityRepository $facilityRepository;

    /**
     * @param UserRepository $user
     * @param LocationRepository $local
     * @param FacilityRepository $facility
     */
    public function __construct(UserRepository $user, LocationRepository $local, FacilityRepository $facility)
    {
        $this->userRepository = $user;
        $this->locationRepository = $local;
        $this->facilityRepository = $facility;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createFacility()
    {
        $userData = $facilityData = [];
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

        $facilityData = $this->dto->all();
        $facility = $this->facilityRepository->create($facilityData);

        activity()->performedOn($user)
            ->causedBy($facility)
            ->withProperties(['user_id' => request()->user()->id, 'create_facility_id' => $user->id])
            ->log('User use create facility admin');

        return $facility;
    }
}
