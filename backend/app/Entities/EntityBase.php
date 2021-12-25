<?php

namespace App\Entities;

abstract class EntityBase
{
    /**
     * @var array
     */
    public $collect = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->instance($data);
    }

    /**
     * @param $data
     * @return void
     */
    public function instance(array $data)
    {
        $this->collect = collect($data);
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return $this->collect->toArray();
    }
}
