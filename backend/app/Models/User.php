<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
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
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public const SUPERADMIN = 'superadmin';
    public const MANAGER    = 'manager';
    public const FACILITY   = 'facility';
    public const PROVIDER   = 'provider';
    public const COMPANY    = 'company';
    public const EMPLOYEE   = 'employee';

    public const TIME_ZONE_DEFAULT = 'America/New_York';

    public const PASSWORD_REGEX = '';

    public const EXPORT_NAME_MODEL = 'App\Exports\UsersExport';

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
        'time_zone',
        'archived'
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

    /**
     * @return boolean
     */
    public function isArchived()
    {
        return $this->trashed();
    }

    /**
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->role == self::SUPERADMIN;
    }

    /**
     * @return bool
     */
    public function isManager()
    {
        return $this->role == self::MANAGER;
    }

    /**
     * @return bool
     */
    public function isFacility()
    {
        return $this->role == self::FACILITY;
    }

    /**
     * @return bool
     */
    public function isProvider()
    {
        return $this->role == self::PROVIDER;
    }

    /**
     * @return bool
     */
    public function isCompany()
    {
        return $this->role == self::COMPANY;
    }

    /**
     * @return bool
     */
    public function isEmployee()
    {
        return $this->role == self::EMPLOYEE;
    }

    public function exportNameModel()
    {
        return self::EXPORT_NAME_MODEL;
    }
}
