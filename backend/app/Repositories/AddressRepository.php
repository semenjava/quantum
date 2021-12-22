<?php

namespace App\Repositories;

use App\Entities\AddressEntity;
use App\Models\Address;
use App\Models\ProviderAddress;

class AddressRepository extends BaseRepository
{
    public static function init()
    {
        return new self();
    }

    /**
     * @param AddressEntity $entity
     * @param int|null $provider_id
     * @return Address
     */
    public function save(AddressEntity $entity, int $provider_id = null): Address
    {
        if($entity->hasId()) {
            $address = Address::find($entity->getId());
        } else {
            $address = new Address();
        }

        $address->fill($entity->toArray());

        $address->save();

        return $address;
    }
}
