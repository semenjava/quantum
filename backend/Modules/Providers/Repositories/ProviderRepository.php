<?php

namespace Modules\Providers\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Providers;

/**
 * Class UserRepository.
 */
class ProviderRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Providers::class;
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
