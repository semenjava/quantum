<?php

namespace App\GraphQL\Mutations;

use App\Contract\Action;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

abstract class BaseMutator
{
    /**
     * @var Action
     */
    protected Action $action;

    /**
     * @param Action $action
     */
    public function __construct(Action $action)
    {
        $this->action = $action;
    }

    /**
     * @param $rootValue
     * @param array $args
     * @param GraphQLContext $context
     * @param ResolveInfo $resolveInfo
     * @return mixed
     */
    abstract public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo);
}
