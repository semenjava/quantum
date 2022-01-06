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
        'primary_address',
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
    public function isPrimary()
    {
        return isset($this->primary_address);
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
}
