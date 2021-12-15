<?php

namespace App\GraphQL\Queries;

class UsersQuery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        dd($args);
    }
}
