<?php

namespace App\Repositories;

use App\Models\Countries;
use App\Models\Cities;
use App\Entities\AddressEntity;

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
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(array $data)
    {
        $result = [];

        if (!$country = $this->hasCountry($data['country'], $data['region'])) {
            $country = new Countries();
            $country->code = mb_strtoupper(mb_substr($data['country'], 0, 2));
            $country->name = $data['country'];
            $country->continent = Countries::EUROPE;
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

        foreach ($data['address'] as $item) {
            $item['country_id'] = $country->id;
            $item['city_id'] = $city->id;

            $address = new AddressEntity($item);
            $address = AddressRepository::init()->save($address);
            $result['addresses'][] = $address;
        }

        return $result;
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
}
