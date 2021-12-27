<?php

namespace Modules\Export\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\User;
use Modules\Export\Builders\UserBuilder;
use App\Contract\ExportRepository;

/**
 * Class UserRepository.
 */
class UserRepository extends BaseRepository implements ExportRepository
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
     * @param array $data
     * @return void
     */
    public function queryAll(array $data)
    {
        $this->newQuery()->eagerLoad();

        $builder = new UserBuilder($this->query);
        $builder->select();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        $result = $builder->where('archived', $data['archived'] ?? false)->all();

        return $result;
    }

}
