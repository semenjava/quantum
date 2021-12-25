<?php

namespace App\GraphQL\Queries;

use App\Contract\Action;
use GraphQL\Type\Definition\ResolveInfo;
use Modules\Export\Http\Requests\ExportRequest;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use App\GraphQL\Mutations\BaseMutator;
use Modules\Export\Http\Actions\ExportAction;

class ExportQuery extends BaseMutator
{
    public function __construct(ExportAction $action)
    {
        parent::__construct($action);
    }

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
        $request = new ExportRequest();
        $dto = $request->valid($args)->toDto();
        return $this->action->run($dto);
    }
}
