<?php

namespace Modules\Auth\Builders;

use App\Builders\BaseBuilder;

class CompanyBuilder extends BaseBuilder
{
    public function select()
    {
        $this->query->select('companies.*');
        return $this;
    }

    public function search($search)
    {
        $this->query->where(function ($q) use ($search) {
            $q->where('companies.name', 'like', "%$search%")
                ->orWhere('companies.phone', 'like', "%$search%")
                ->orWhere('companies.fax', 'like', "%$search%");
        });
        return $this;
    }

    public function joinUser()
    {
        $this->query->leftJoin('users', 'users.id', '=', 'companies.user_id');
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
