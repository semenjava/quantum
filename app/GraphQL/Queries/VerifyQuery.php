<?php

namespace App\GraphQL\Queries;

use App\Properties\Property;
use GraphQL\Type\Definition\ResolveInfo;
use Modules\Auth\Http\Actions\AuthAction;
use Modules\Auth\Http\Actions\VerificationAction;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\Auth\Http\Requests\VerifyRequest;

class VerifyQuery
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
    public function verify($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $request = new VerifyRequest();
        $request->valid($args);
        $request->request->add($args);
        return (new VerificationAction())->verify($request);
    }
}
