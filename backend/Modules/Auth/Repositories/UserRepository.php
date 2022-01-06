<?php

namespace Modules\Auth\Repositories;

use App\Models\Companies;
use App\Models\Employees;
use App\Models\Facilities;
use App\Models\Provider;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\User;
use Modules\Auth\Builders\CompanyBuilder;
use Modules\Auth\Builders\EmployeeBuilder;
use Modules\Auth\Builders\FacilityBuilder;
use Modules\Auth\Builders\ProviderBuilder;
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
        $pagination = $builder->where('archived', $data['archived'] ?? false)
            ->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }

    public function getFacility(array $data)
    {
        $builder = new FacilityBuilder(Facilities::query());

        $builder->select()->where('user_id', $data['user_id'])->joinUser();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }

    public function getProvider(array $data)
    {
        $builder = new ProviderBuilder(Provider::query());

        $builder->select()->where('user_id', $data['user_id'])->joinUser();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }

    public function getCompany(array $data)
    {
        $builder = new CompanyBuilder(Companies::query());

        $builder->select()->where('user_id', $data['user_id'])->joinUser();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }

    public function getEmployee(array $data)
    {
        $builder = new EmployeeBuilder(Employees::query());

        $builder->select()->where('user_id', $data['user_id'])->joinUser();
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
