<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Countries;
use App\Models\Cities;
use App\Entities\AddressEntity;
use App\Models\ProviderAddress;

/**
 * Class UserRepository.
 */
class LocationRepository
{
    /**
     * @var Countries
     */
    private $country = null;

    /**
     * @var Cities
     */
    private $city = null;

    /**
     * @var AddressRepository
     */
    private $addressRepository;

    public function __construct(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(array $entity)
    {
        $address = new AddressEntity($entity);
        $address = $this->addressRepository->save($address);

        return $address;
    }

    /**
     * @param $countryName
     * @param $region
     * @return mixed
     */
    private function hasCountry($countryName, $region = null)
    {
        $query = Countries::where('local_name', $countryName);
        if ($region) {
            $query->where('region', $region);
        }

        return $query->first();
    }

    /**
     * @param string $cityName
     * @return mixed
     */
    private function hasCity(string $cityName)
    {
        return Cities::where('name', $cityName)->first();
    }

    /**
     * @param array $data
     * @return Address|array
     */
    public function saveCountryAndCity(array $data)
    {
        $result = [];

        if (!$country = $this->hasCountry($data['country'], $data['region'])) {
            $country = new Countries();
            $country->code = mb_strtoupper(mb_substr($data['country'], 0, 2));
            $country->name = $data['country'];
            $country->continent = Countries::SOUTH_AMERICA;
            $country->region = isset($data['region']) ? $data['region'] : 'no-region';
            $country->surface_area = round(100, 1000000);
            $country->local_name = $data['country'];
            $country->government_form = $data['country'];
            $country->code2 = mb_strtoupper(mb_substr($data['country'], 0, 1));
            $country->save();
        }

        if (!$city = $this->hasCity($data['city'])) {
            $city = new Cities();
            $city->name = $data['city'];
            $city->country_code = $country->code;
            $city->district = $country->name;
            $city->save();
        }

        $result['country_id'] = $country->id;
        $result['city_id'] = $city->id;

        if (isset($data['address']) && is_array($data['address'])) {
            foreach ($data['address'] as $entity) {
                $addresses = [];
                $entity['country_id'] = $country->id;
                $entity['city_id'] = $city->id;

                $address = new AddressEntity($entity);
                $address = $this->addressRepository->save($address, $entity['provider_id']);
                $addresses['address_id'] = $address->id;
                $addresses['provider_id'] = $entity['provider_id'];
                $result['addresses'][] = $addresses;
            }
        } else {
            $entity = $data;
            $entity['country_id'] = $country->id;
            $entity['city_id'] = $city->id;

            $address = new AddressEntity($entity);
            $address = $this->addressRepository->save($address, $entity['provider_id']);

            return $address;
        }

        return $result;
    }
}
