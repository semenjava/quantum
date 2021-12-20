<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
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
}
