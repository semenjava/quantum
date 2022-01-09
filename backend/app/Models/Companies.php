<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contract\Address as AddressContract;

class Companies extends Model implements AddressContract
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'companies';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'fax',
        'count_employee'
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
        $isAddress = \DB::table('company_address')->where('company_id', $this->id)->where('address_id', $address_id)->first();
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
        return $this->belongsToMany(Address::class, 'company_address', 'company_id', 'address_id');
    }
}
