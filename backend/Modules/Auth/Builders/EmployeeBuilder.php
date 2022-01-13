<?php

namespace Modules\Auth\Builders;

use App\Builders\BaseBuilder;

class EmployeeBuilder extends UsersBuilder
{
    /**
     * @return $this|EmployeeBuilder
     */
    public function select()
    {
        $this->query->select('employees.*');
        return $this;
    }

    /**
     * @param $search
     * @return $this|EmployeeBuilder
     */
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

    /**
     * @return $this
     */
    public function join()
    {
        $this->query->leftJoin('employees', 'users.id', '=', 'employees.user_id');
        return $this;
    }
}
