<?php

namespace App\Repositories;

use App\Entities\AddressEntity;
use App\Models\Address;
use App\Models\ProviderAddress;

class AddressRepository extends BaseRepository
{
    /**
     * @return AddressRepository
     */
    public static function init()
    {
        return new self();
    }

    /**
     * @param AddressEntity $entity
     * @param int|null $provider_id
     * @return Address
     */
    public function save(AddressEntity $entity): Address
    {
        if ($entity->hasId()) {
            $address = Address::find($entity->getId());
        } else {
            $address = new Address();
        }

        return $this->fillArrayAndSave($address, $entity);
    }

    /**
     * @param AddressEntity $entity
     * @return Address
     */
    public function create(AddressEntity $entity): Address
    {
        return $this->fillArrayAndSave(new Address(), $entity);
    }

    /**
     * @param $address
     * @param AddressEntity $entity
     * @return Address
     */
    public function fillArrayAndSave($address, AddressEntity $entity): Address
    {
        $address->fill($entity->toArray());

        $address->save();

        return $address;
    }
}
