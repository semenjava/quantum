<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use App\Contract\Address as AddressContract;

class Provider extends Model implements AddressContract
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'providers';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'surname',
        'last_name',
        'diagnostic_specialty',
        '2nd_language',
        'status'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facility()
    {
        return $this->belongsToMany(Facilities::class, 'facility_provider', 'provider_id', 'facility_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'provider_address', 'provider_id', 'address_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function specialties()
    {
        return $this->belongsToMany(Specialties::class, 'provider_specialty', 'provider_id', 'specialty_id');
    }


    /**
     * @return mixed
     */
    public function get2ndLanguage()
    {
        return $this->{'2nd_language'};
    }

    /**
     * @return Address ?? null
     */
    public function address($address_id)
    {
        $isAddress = ProviderAddress::where('provider_id', $this->id)->where('address_id', $address_id)->first();
        if ($isAddress) {
            return Address::find($address_id);
        }

        return null;
    }
}
