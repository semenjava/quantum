<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;

    protected $table = 'countries';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'code',
        'name',
        'continent',
        'region',
        'surface_area',
        'indep_year',
        'population',
        'life_expectancy',
        'gnp',
        'gnp_old',
        'local_name',
        'government_form',
        'head_of_state',
        'capital',
        'code2'
    ];

    /**
     * Get the comments for the blog post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(Cities::class, 'capital');
    }
}
