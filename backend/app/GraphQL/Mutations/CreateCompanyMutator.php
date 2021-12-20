<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Modules\Auth\Http\Actions\RegisterAction;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\Auth\Http\Requests\RegisterRequest;
use Modules\Auth\Http\Actions\AuthAction;

class CreateCompanyMutator
{
    /**
     * Return a value for the field.
     *
     * @param  null  $rootValue Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return mixed
     */
    public function resolve($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $request = new RegisterRequest();
        $dto = $request->valid($args)->toDto();
        return RegisterAction::register($dto);
    }
}
