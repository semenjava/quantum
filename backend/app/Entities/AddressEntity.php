<?php

namespace App\Entities;

use App\Models\Address;
use App\Models\ProviderAddress;

class AddressEntity extends EntityBase
{

    /**
     * @param array $data
     * @return void
     */
    public function instance(array $data)
    {
        parent::instance($data);
    }

    /**
     * @return bool
     */
    public function hasId()
    {
        $model = Address::select('id')
            ->where('address_line_1', $this->getAddressLine1())
            ->where('address_line_2', $this->getAddressLine2())
            ->where('country_id', $this->getCountryId())
            ->where('city_id', $this->getCityId())
            ->where('postal', $this->getPostal())
            ->first();

        if($model) {
            $this->collect->put('id', $model->id);
        }

        return $this->collect->has('id');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->collect->get('id');
    }

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->collect->get('address_line_1');
    }

    /**
     * @return string
     */
    public function getAddressLine2(): string
    {
        return $this->collect->get('address_line_2');
    }

    /**
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->collect->get('country_id');
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->collect->get('city_id');
    }

    /**
     * @return string
     */
    public function getPostal(): string
    {
        return $this->collect->get('postal');
    }

    /**
     * @return bool
     */
    public function isPrimaryAddress(): bool
    {
        return $this->collect->get('primary_address');
    }

    /**
     * @return bool
     */
    public function isBillingAddress(): bool
    {
        return $this->collect->get('billing_address');
    }

    /**
     * @return bool
     */
    public function isPostalAddress(): bool
    {
        return $this->collect->get('postal_address');
    }
}
