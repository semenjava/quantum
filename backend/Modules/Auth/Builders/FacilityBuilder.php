<?php

namespace Modules\Auth\Builders;

use App\Builders\BaseBuilder;

class FacilityBuilder extends UsersBuilder
{
    /**
     * @return $this|FacilityBuilder
     */
    public function select()
    {
        $this->query->select('facilities.*');
        return $this;
    }

    /**
     * @param $search
     * @return $this|FacilityBuilder
     */
    public function search($search)
    {
        $this->query->where(function ($q) use ($search) {
            $q->where('facilities.name', 'like', "%$search%");
        });
        return $this;
    }

    /**
     * @return $this
     */
    public function join()
    {
        $this->query->leftJoin('facilities', 'users.id', '=', 'facilities.user_id');
        return $this;
    }
}
