<?php

namespace Modules\Auth\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\User;
use Modules\Auth\Builders\UsersBuilder;

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

    public function users(array $data)
    {
        $this->newQuery()->eagerLoad();

        $builder = new UsersBuilder($this->query);

        $builder->select();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }
}
