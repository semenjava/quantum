<?php

namespace App\Services;

use App\Properties\Property;

class BaseService
{
    /**
     * @var array
     */
    protected $s = [];

    /**
     * @var Property
     */
    protected $dto;

    /**
     * @param $name
     * @param $value
     * @return void
     */
    public function __set($name, $value)
    {
        $this->s[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->s[$name]($this);
    }

    /**
     * @param Property $dto
     * @return $this
     */
    public function setParam(Property $dto)
    {
        $this->dto = $dto;
        return $this;
    }
}
