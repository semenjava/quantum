<?php

namespace App\Entities;

abstract class EntityBase
{
    /**
     * @var array
     */
    public $collect = [];

    /**
     * @param ...$data
     */
    public function __construct(...$data)
    {
        $this->instance($data);
    }

    /**
     * @param ...$data
     * @return void
     */
    public function instance(...$data)
    {
        $this->collect = collect($data);
        foreach ($data as $key => $val) {
            $this->{$key} = $val;
        }
    }

    /**
     * @return mixed
     */
    public function toArray()
    {
        return $this->collect->toArray();
    }
}
