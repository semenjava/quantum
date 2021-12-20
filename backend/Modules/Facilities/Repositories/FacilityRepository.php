<?php

namespace Modules\Facilities\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Facilities;

/**
 * Class UserRepository.
 */
class FacilityRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Facilities::class;
    }

    /**
     * @return FacilityRepository
     */
    public static function init()
    {
        return new self();
    }

    /**
    * @param array $data
    * @return \Illuminate\Database\Eloquent\Model
    */
    public function create(array $data)
    {
        return parent::create($data);
    }
}
