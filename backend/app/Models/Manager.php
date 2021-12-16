<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'managers';

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'surname',
        'last_name',
        'address',
        'postal',
        'status'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
