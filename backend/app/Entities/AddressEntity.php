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
        $query = Address::select('addresses.*');
        if ($this->collect->has('provider_id')) {
            $query->joinProvider($this->getProviderId());
        }
        if ($this->collect->has('facility_id')) {
            $query->joinFacility($this->getFacilityId());
        }
        if ($this->collect->has('company_id')) {
            $query->joinCompany($this->getCompanyId());
        }
        if ($this->collect->has('employee_id')) {
            $query->joinEmployee($this->getEmployeeId());
        }
        $model = $query->first();

        if ($model) {
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
    public function getCountry(): string
    {
        return $this->collect->get('country');
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->collect->get('state');
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->collect->get('city');
    }

    /**
     * @return mixed
     */
    public function getProviderId()
    {
        return $this->collect->get('provider_id');
    }

    /**
     * @return mixed
     */
    public function getFacilityId()
    {
        return $this->collect->get('facility_id');
    }

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->collect->get('company_id');
    }

    /**
     * @return mixed
     */
    public function getEmployeeId()
    {
        return $this->collect->get('employee_id');
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
