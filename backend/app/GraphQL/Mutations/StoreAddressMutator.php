<?php

namespace App\GraphQL\Mutations;

use App\Properties\Property;
use GraphQL\Type\Definition\ResolveInfo;
use Modules\Address\Http\Requests\AddressBoolRequest;
use Modules\Address\Http\Requests\StoreAddressRequest;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Modules\Address\Http\Actions\StoreAddressAction;
use App\Contract\Action;

class StoreAddressMutator extends BaseMutator
{
    private $requestStore;

    public function __construct(StoreAddressAction $action)
    {
        parent::__construct($action);
        $this->requestStore = new StoreAddressRequest;
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
        if (!empty($args['addresses'])) {
            foreach ($args['addresses'] as $address) {
                $address['provider_id'] = $args['provider_id'];
                $address['facility_id'] = $args['facility_id'];
                $address['company_id'] = $args['company_id'];
                $address['employee_id'] = $args['employee_id'];

                $dtos[] = $this->requestStore->valid($address)->toDto();
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
        } else {
            $address['provider_id'] = $args['provider_id'];
            $address['facility_id'] = $args['facility_id'];
            $address['company_id'] = $args['company_id'];
            $address['employee_id'] = $args['employee_id'];

            $data = new Property($address);

            $result = $this->action->deleteAllAddresses($data);
        }

        return $result;
    }
}
