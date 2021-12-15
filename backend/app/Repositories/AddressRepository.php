<?php

namespace App\Repositories;

use App\Entities\AddressEntity;
use App\Models\Addresses;

class AddressRepository
{

    /**
     * @return AddressRepository
     */
    public function init()
    {
        return new self();
    }

    /**
     * @param AddressEntity $entity
     * @param int|null $provider_id
     * @return Addresses
     */
    public function save(AddressEntity $entity, int $provider_id = null): Addresses
    {
        if($entity->hasId() && !$address = Addresses::find($entity->getId()))
        {
            $address = new Addresses();
        }

        $address->fill($entity->toArray());
        $address->save();

        return $address;
    }

}
