<?php

namespace Modules\Export\Builders;

use App\Builders\BaseBuilder;

class UserBuilder extends BaseBuilder
{
    /**
     * @return $this
     */
    public function select()
    {
        $this->query->select('*');
        return $this;
    }

    /**
     * @param $search
     * @return $this
     */
    public function search($search)
    {
        $this->query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        });
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function where($key, $value)
    {
        $this->query->where($key, $value);
        return $this;
    }

    /**
     * @param array $sort
     * @return $this
     */
    public function orderBy(array $sort)
    {
        foreach ($sort as $value) {
            $this->query->orderBy($value['column'], $value['order']);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->query->get();
    }
}
