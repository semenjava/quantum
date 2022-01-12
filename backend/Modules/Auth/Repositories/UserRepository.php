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
        if (!empty($data['archived'])) {
            $builder->archived();
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }

    public function getFacility(array $data)
    {
        $this->newQuery()->eagerLoad();

        $builder = new FacilityBuilder($this->query);

        $builder->select()->join();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        if (!empty($data['archived'])) {
            $builder->archived();
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }

    public function getProvider(array $data)
    {
        $this->newQuery()->eagerLoad();

        $builder = new ProviderBuilder($this->query);

        $builder->select()->join();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        if (!empty($data['archived'])) {
            $builder->archived();
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }

    public function getCompany(array $data)
    {
        $this->newQuery()->eagerLoad();

        $builder = new CompanyBuilder($this->query);

        $builder->select()->join();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        if (!empty($data['archived'])) {
            $builder->archived();
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }

    public function getEmployee(array $data)
    {
        $this->newQuery()->eagerLoad();

        $builder = new EmployeeBuilder($this->query);

        $builder->select()->join();
        if (isset($data['search'])) {
            $builder->search($data['search']);
        }
        if (isset($data['sort'])) {
            $builder->orderBy($data['sort']);
        }
        if (!empty($data['archived'])) {
            $builder->archived();
        }
        $pagination = $builder->pagination($data['first'] ?? null, $data['page'] ?? null);

        return $pagination;
    }
}
