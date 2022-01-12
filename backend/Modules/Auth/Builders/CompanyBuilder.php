<?php

namespace Modules\Auth\Builders;

use App\Builders\BaseBuilder;

class CompanyBuilder extends UsersBuilder
{
    /**
     * @return $this|CompanyBuilder
     */
    public function select()
    {
        $this->query->select('companies.*');
        return $this;
    }

    /**
     * @param $search
     * @return $this|CompanyBuilder
     */
    public function search($search)
    {
        $this->query->where(function ($q) use ($search) {
            $q->where('companies.name', 'like', "%$search%")
                ->orWhere('companies.phone', 'like', "%$search%")
                ->orWhere('companies.fax', 'like', "%$search%");
        });
        return $this;
    }

    /**
     * @return $this
     */
    public function join()
    {
        $this->query->leftJoin('companies', 'users.id', '=', 'companies.user_id');
        return $this;
    }
}
