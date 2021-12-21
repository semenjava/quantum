<?php

namespace App\Entities;

class AddressEntity extends EntityBase
{
    /**
     * @var int
     */
    private int $id;

    /**
     * @var string
     */
    private string $address_line_1;

    /**
     * @var string
     */
    private string $address_line_2;

    /**
     * @var int
     */
    private int $country_id;

    /**
     * @var int
     */
    private int $city_id;

    /**
     * @var string
     */
    private string $postal;

    /**
     * @var bool
     */
    private bool $primary_address;

    /**
     * @var bool
     */
    private bool $billing_address;

    public function hasId()
    {
        return isset($this->id);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAddressLine1(): string
    {
        return $this->address_line_1;
    }

    /**
     * @return string
     */
    public function getAddressLine2(): string
    {
        return $this->address_line_2;
    }

    /**
     * @return int
     */
    public function getCountryId(): int
    {
        return $this->country_id;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->city_id;
    }

    /**
     * @return string
     */
    public function getPostal(): string
    {
        return $this->postal;
    }

    /**
     * @return bool
     */
    public function isPrimaryAddress(): bool
    {
        return $this->primary_address;
    }

    /**
     * @return bool
     */
    public function isBillingAddress(): bool
    {
        return $this->billing_address;
    }
}
