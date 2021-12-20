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
        'country_id',
        'city_id',
        'postal',
        'postal_address',
        'primary_address',
        'billing_address'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Countries::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(Cities::class);
    }

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
    public function getCountryAttribute()
    {
        return $this->country()->name();
    }

    /**
     * @return mixed
     */
    public function getRegionAttribute()
    {
        return $this->country()->region();
    }

    /**
     * @return mixed
     */
    public function getCityAttribute()
    {
        return $this->city()->name();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function provider()
    {
        return $this->belongsToMany(Provider::class, 'provider_address', 'address_id', 'provider_id');
    }
}
