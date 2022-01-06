<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderAddress extends Model
{
    use HasFactory;

    protected $table = 'provider_address';

    protected $fillable = [
        'provider_id',
        'address_id'
    ];
}
