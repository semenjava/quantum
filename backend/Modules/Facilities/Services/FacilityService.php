<?php

namespace Modules\Facilities\Services;

use Modules\Facilities\Repositories\FacilityRepository;
use Hash;
use App\Repositories\LocationRepository;
use Modules\Facilities\Repositories\UserRepository;
use App\Services\BaseService;
use App\Models\User;

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
        $user = $this->userRepository->create([
            'name' => $this->dto->get('name'),
            'email' => $this->dto->get('email'),
            'password' => $this->dto->has('password') ? Hash::make($this->dto->get('password')) : Hash::make($this->dto->get('name')),
            'role' => User::FACILITY,
            'time_zone' =>  $this->dto->has('time_zone') ? $this->dto->get('time_zone') : User::TIME_ZONE_DEFAULT
        ]);

        $this->dto->remove('email');
        $this->dto->remove('password');

        $this->dto->set('user_id', $user->id);

        $facility = $this->facilityRepository->create($this->dto->all());

        activity()->performedOn($user)
            ->causedBy($facility)
            ->withProperties(['user_id' => request()->user()->id, 'create_facility_id' => $facility->id])
            ->log('Create user to role facility admin');

        return $facility;
    }
}
