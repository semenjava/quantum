<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contract\Address as AddressContract;

class Facilities extends Model implements AddressContract
{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = [
        'user_id',
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Address ?? null
     */
    public function address($address_id)
    {
        $isAddress = \DB::table('facility_address')->where('facility_id', $this->id)->where('address_id', $address_id)->first();
        if ($isAddress) {
            return Address::find($address_id);
        }

        return null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'facility_address', 'facility_id', 'address_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function specialties()
    {
        return $this->belongsToMany(Specialties::class, 'facility_specialty', 'facility_id', 'specialty_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'facility_provider', 'facility_id', 'provider_id');
    }
}
