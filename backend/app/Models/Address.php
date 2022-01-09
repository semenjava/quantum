<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'addresses';

    /**
     * @var string[]
     */
    protected $fillable = [
        'address_line_1',
        'address_line_2',
        'country',
        'state',
        'city',
        'postal',
        'postal_address',
        'office_address',
        'billing_address'
    ];

    /**
     * @return bool
     */
    public function isPostal()
    {
        return isset($this->postal_address);
    }


    /**
     * @return bool
     */
    public function isOffice()
    {
        return isset($this->office_address);
    }

    /**
     * @return bool
     */
    public function isBilling()
    {
        return isset($this->billing_address);
    }

    /**
     * @return mixed
     */
    public function getCountryName()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getStateName()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->city;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function provider()
    {
        return $this->belongsToMany(Provider::class, 'provider_address', 'address_id', 'provider_id');
    }

    /**
     * @param $query
     * @param $provider_id
     * @return mixed
     */
    public function scopeJoinProvider($query, $provider_id)
    {
        return $query->leftJoin('provider_address', 'provider_address.address_id', '=', $this->table.'.id')
            ->where('provider_address.provider_id', $provider_id);
    }

    /**
     * @param $query
     * @param $facility_id
     * @return mixed
     */
    public function scopejoinFacility($query, $facility_id)
    {
        return $query->leftJoin('facility_address', 'facility_address.address_id', '=', $this->table.'.id')
            ->where('facility_address.facility_id', $facility_id);
    }

    /**
     * @param $query
     * @param $company_id
     * @return mixed
     */
    public function scopejoinCompany($query, $company_id)
    {
        return $query->leftJoin('company_address', 'company_address.address_id', '=', $this->table.'.id')
            ->where('company_address.company_id', $company_id);
    }

    /**
     * @param $query
     * @param $employee_id
     * @return mixed
     */
    public function scopejoinEmployee($query, $employee_id)
    {
        return $query->leftJoin('employee_address', 'employee_address.address_id', '=', $this->table.'.id')
            ->where('employee_address.employee_id', $employee_id);
    }
}
