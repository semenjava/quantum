<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseBuilder
{
    public $query;

    public function __construct(Builder $query)
    {
        $this->query = $query;
    }

    public function toSql()
    {
        return vsprintf(str_replace(['?'], ['\'%s\''], $this->query->toSql()), $this->query->getBindings());
    }
}
