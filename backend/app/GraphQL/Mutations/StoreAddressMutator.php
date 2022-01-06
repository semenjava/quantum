<?php

namespace App\GraphQL\Mutations;

use GraphQL\Type\Definition\ResolveInfo;
use Modules\Address\Facades\CreateAddressFacade;
use Modules\Address\Http\Requests\AddressBoolRequest;
use Modules\Address\Http\Requests\StoreAddressRequest;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\Address\Http\Actions\StoreAddressAction;
use App\Contract\Action;

class StoreAddressMutator extends BaseMutator
{
    private $request;

    public function __construct(StoreAddressAction $action, StoreAddressRequest $request)
    {
        parent::__construct($action);
        $this->request = $request;
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
        $dtos = $address_bool = [];
        if (isset($args['addresses'])) {
            foreach ($args['addresses'] as $address) {
                $dtos[] = $this->request->valid($address)->toDto();
                if ($address['postal_address']) {
                    $address_bool['postal_address'][] = $address['postal_address'];
                }
                if ($address['office_address']) {
                    $address_bool['office_address'][] = $address['office_address'];
                }
                if ($address['billing_address']) {
                    $address_bool['billing_address'][] = $address['billing_address'];
                }
            }

            (new AddressBoolRequest())->valid($address_bool)->toDto();

            $result = $this->action->storeAddress($dtos);
        }

        return $result;
    }
}
