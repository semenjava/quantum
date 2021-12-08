<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $table = 'cities';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'country_code',
        'district',
        'population'
    ];

    /**
     * Get the post that owns the comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Countries::class, 'capital');
    }
}
