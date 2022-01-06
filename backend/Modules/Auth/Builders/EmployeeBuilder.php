<?php

namespace Modules\Auth\Builders;

use App\Builders\BaseBuilder;

class EmployeeBuilder extends BaseBuilder
{
    public function select()
    {
        $this->query->select('employees.*');
        return $this;
    }

    public function search($search)
    {
        $this->query->where(function ($q) use ($search) {
            $q->where('employees.first_name', 'like', "%$search%")
                ->orWhere('employees.surname', 'like', "%$search%")
                ->orWhere('employees.last_name', 'like', "%$search%")
                ->orWhere('employees.company_id', 'like', "%$search%");
        });
        return $this;
    }

    public function joinUser()
    {
        $this->query->leftJoin('users', 'users.id', '=', 'employees.user_id');
        return $this;
    }

    public function where($key, $value)
    {
        $this->query->where($key, $value);
        return $this;
    }

    public function orderBy(array $sort)
    {
        foreach ($sort as $value) {
            $this->query->orderBy($value['column'], $value['order']);
        }
        return $this;
    }

    public function pagination($first = 10, $page = 0)
    {
        return $this->query->paginate($first, ['*'], 'page', $page);
    }
}
