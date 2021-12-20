<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasRolesAndPermissions;
use Kodeine\Acl\Traits\HasRole;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRole;

    public const SUPERADMIN = 'superadmin';
    public const MANAGER    = 'manager';
    public const FACILITY   = 'facility';
    public const PROVIDER   = 'provider';
    public const COMPANY    = 'company';
    public const EMPLOYEE   = 'employee';

    public const PASSWORD_REGEX = '';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'time_zone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
//    protected $with = ['permissions', 'role'];
}
