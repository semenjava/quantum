<?php

namespace Modules\Auth\Builders;

use App\Builders\BaseBuilder;

class ProviderBuilder extends UsersBuilder
{
    /**
     * @return $this|ProviderBuilder
     */
    public function select()
    {
        $this->query->select('providers.*');
        return $this;
    }

    /**
     * @param $search
     * @return $this|ProviderBuilder
     */
    public function search($search)
    {
        $this->query->where(function ($q) use ($search) {
            $q->where('providers.first_name', 'like', "%$search%")
                ->orWhere('providers.surname', 'like', "%$search%")
                ->orWhere('providers.last_name', 'like', "%$search%")
                ->orWhere('providers.diagnostic_specialty', 'like', "%$search%");
        });
        return $this;
    }

    /**
     * @return $this
     */
    public function join()
    {
        $this->query->leftJoin('providers', 'users.id', '=', 'providers.user_id');
        return $this;
    }
}
