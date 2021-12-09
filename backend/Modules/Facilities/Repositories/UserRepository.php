<?php

namespace Modules\Facilities\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\User;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    /**
     * @return UserRepository
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
