<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contract\Address as AddressContract;

class Employees extends Model implements AddressContract
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'employees';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'surname',
        'last_name',
        'company_id',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Companies::class);
    }

    /**
     * @return Address ?? null
     */
    public function address($address_id)
    {
        $isAddress = \DB::table('employee_address')->where('employee_id', $this->id)->where('address_id', $address_id)->first();
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
        return $this->belongsToMany(Address::class, 'employee_address', 'employee_id', 'address_id');
    }
}
