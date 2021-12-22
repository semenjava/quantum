<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facility()
    {
        return $this->belongsToMany(Facilities::class, 'facility_provider', 'provider_id', 'facility_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->belongsToMany(Addresses::class, 'provider_address', 'provider_id', 'address_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function specialties()
    {
        return $this->belongsToMany(Specialties::class, 'provider_specialty', 'provider_id', 'specialty_id');
    }

    public function get2ndLanguage()
    {
        return $this->{'2nd_language'};
    }
}
